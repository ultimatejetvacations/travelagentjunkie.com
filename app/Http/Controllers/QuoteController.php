<?php namespace App\Http\Controllers;

use App\Entities\PostSale;
use App\Entities\Quote;
use App\Entities\QuoteOption;
use App\Exceptions\CustomExceptions\InternalErrorException;
use App\Exceptions\CustomExceptions\UnknownModelException;
use App\Http\Requests\ApproveOptionRequest;
use App\Http\Requests\CreateCreditCardRequest;
use App\Http\Requests\CreateCustomerProfileRequest;
use App\Http\Requests\CreatePostSaleRequest;
use App\Http\Requests\CreateTravelerRequest;
use App\Repositories\Contracts\IMemberCustomerProfileRepository;
use App\Repositories\Contracts\IMemberTravelerRepository;
use App\Repositories\Contracts\IPostSaleTravelerRepository;
use App\Repositories\Contracts\IQuoteOptionAirlineRepository;
use App\Repositories\Contracts\IQuoteOptionHotelRoomRepository;
use App\Repositories\Contracts\IQuoteOptionRepository;
use App\Repositories\Contracts\IQuoteOptionVendorRepository;
use App\Repositories\Contracts\IQuoteRepository;
use App\Repositories\MemberCustomerProfileRepository;
use App\Services\Authorize\Authorize;
use Illuminate\Database\Eloquent\Collection;

class QuoteController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{

	}

    /**
     * @param $quoteOptionId
     * @param ApproveOptionRequest $request
     * @param IQuoteOptionAirlineRepository $quoteOptionAirlineRepository
     * @param IQuoteOptionHotelRoomRepository $quoteOptionHotelRoomRepository
     * @param IQuoteOptionVendorRepository $quoteOptionVendorRepository
     * @param IQuoteOptionRepository $quoteOptionRepository
     * @return mixed
     */
    public function approveOption($quoteOptionId, ApproveOptionRequest $request,
                                  IQuoteOptionAirlineRepository $quoteOptionAirlineRepository, IQuoteOptionHotelRoomRepository $quoteOptionHotelRoomRepository,
                                  IQuoteOptionVendorRepository $quoteOptionVendorRepository, IQuoteOptionRepository $quoteOptionRepository)
    {
        $quoteOption = $quoteOptionRepository->getEntity()->where('quote_option_id', '=', $quoteOptionId)->get()->first();
        $quote = $quoteOption->quote()->get()->first();

        // Update Airlines
        if (count($request->get('air')) > 0)
        {
            foreach ($request->get('air') as $airId) {
                $quoteOptionAirlineRepository->getEntity()->where('quote_airline_id', '=', $airId)->update(['selected' => 'y']);
            }
        }
        else // Deselect all Airlines
        {
            foreach($quoteOption->airlines()->get()->all() as $airline){
                $airline->selected = 'n';
                $airline->save();
            }
        }

        // Update Hotel Rooms
        if (count($request->get('hotel_room')) > 0)
        {
            foreach ($request->get('hotel_room') as $roomId) {
                $quoteOptionHotelRoomRepository->getEntity()->where('quote_option_room_id', '=', $roomId)->update(['selected' => 'y']);
            }
        }
        else // Deselect all Hotel Rooms
        {
            foreach($quoteOption->rooms()->get()->all() as $room){
                $room->selected = 'n';
                $room->save();
            }
        }

        // Update Services
        if (count($request->get('service')) > 0)
        {
            foreach ($request->get('service') as $serviceId) {
                $quoteOptionVendorRepository->getEntity()->where('quote_options_vendor_id', '=', $serviceId)->update(['selected' => 'y']);
            }
        }
        else // Deselect all Services
        {
            foreach($quoteOption->vendors()->get()->all() as $service){
                $service->selected = 'n';
                $service->save();
            }
        }

        // Update Insurance
        if (count($request->get('insurance')) > 0)
        {
            foreach ($request->get('insurance') as $insuranceId) {
                $quoteOptionRepository->getEntity()->where('quote_option_id', '=', $insuranceId)->update(['insurance_selected' => 'y']);
            }
        }
        else // Deselect Insurance
        {
            $quoteOption->insurance_selected = 'n';
            $quoteOption->save();
        }

        // Update quote option
        $quoteOption->selected = 'y';
        $quoteOption->approve_comments = $request->get('approve_comments');
        $quoteOption->save();

        // Update master quote status
        $quote->status = 'Accepted';
        $quote->save();

        return \Redirect::route('quote', $quote->token);
    }

    /**
     * @param CreateCustomerProfileRequest $request
     * @param IQuoteRepository $quoteRepository
     * @param MemberCustomerProfileRepository $memberCustomerProfileRepository
     * @param Authorize $authorize
     * @return mixed
     * @throws UnknownModelException
     */
    public function createCustomerProfile(CreateCustomerProfileRequest $request, IQuoteRepository $quoteRepository, MemberCustomerProfileRepository $memberCustomerProfileRepository, Authorize $authorize)
    {
        // To use testing uncomment the following line
        $authorize = new Authorize($test = true);

        // Select quote
        $quote = $quoteRepository->getEntity()->where('token', '=', $request->get('token'))->get()->first();
        // Check the quote is not empty
        if( ! $quote instanceof Quote)
            throw new UnknownModelException(new \Exception('The quote you are looking for does not exist.'));

        // Select quote member
        $member = $quote->member()->get()->first();

        $description = "member_id:".$member->member_id."-traveler_id:".$request->get('traveler_id');
        $customerProfileId = $authorize->createProfile($description);
        $data = ['member_id' => $member->member_id, 'traveler_id' => $request->get('traveler_id'), 'customerProfileId' => $customerProfileId];
        if($customerProfileId > 0)
        {
            if( ! $memberCustomerProfileRepository->getEntity()->create($data))
                return \Redirect::back()->withInput()->withErrors(['response_error' => "Payment Profile created, but we could not save the record in the database. This is the ProfileID for authorize.net: '".$customerProfileId."'. Please write it down and contact technical support."]);
        }
        else
            return \Redirect::back()->withInput()->withErrors(['response_error' => "Error trying to create the payment profile."]);

        return \Redirect::route('quote.secondStep', $request->get('token'));
    }

    public function createPostSale(CreatePostSaleRequest $request, IQuoteRepository $quoteRepository)
    {
        $token = $request->get('token');

        // Select quote based on token
        $quote = $quoteRepository->getEntity()->where('token', '=', $token)->get()->first();

        // Validate if the quote has an approved option
        $quoteOption = $quote->quoteOptions()->get()->filter(function($item) { return $item->selected == 'y'; })->first();

        // Prepare variables for outside request
        $url = "https://ujv.travelagentadmin.com/quotes/test.php?quote_id=".$quote->quote_id;
        $credentials = ['userName' => 'travelAgentJunkie', 'passWord' => \Hash::make('F#T#A@305')];
        $data = [
            'userName'          =>  $credentials['userName'],
            'passWord'          =>  $credentials['passWord'],
            'action'            =>  'proceed_to_post_sale',
            'quote_option_id'   =>  $quoteOption->quote_option_id
        ];

		// url-ify the data for the POST
		$fields_string = '';
		foreach($data as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

        //open connection
		$ch = curl_init();

        //set the url, POST data
        curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields_string));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		//execute post
		if( ! $result = curl_exec($ch))
	    {
	        trigger_error(curl_error($ch));
	    }
        // curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);
        // curl_setopt($ch,CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);

        //close connection
        curl_close($ch);

        dd($result);
    }

    /**
     * @param IQuoteRepository $quoteRepository
     * @param $token
     * @return \Illuminate\View\View
     * @throws InternalErrorException
     * @throws UnknownModelException
     */
    public function quote(IQuoteRepository $quoteRepository, $token)
    {
        // Select quote based on token
        $quote = $quoteRepository->getEntity()->where('token', '=', $token)->get()->first();

        // Check the quote is not empty
        if( ! $quote instanceof Quote)
            throw new UnknownModelException(new \Exception('The quote you are looking for does not exist.'));

        // Select quote member
        $member = $quote->member()->get()->first();

        // Select Travel Agency
        $travelAgency = $member->agency()->get()->first();

        // Select the options for the quote
        $options = $quote->quoteOptions()->where('hidden', '=', 0)->orderBy('position')->get();

        if(count($options->all()) < 1)
            throw new InternalErrorException(new \Exception('Sorry the quote you are looking for does not have options.'));

        // Check if there is an approved option and if so, load the approved view
        $acceptedOption = $options->filter(function($item) { return ($item->selected == 'y'); })->first();
        if($acceptedOption)
            return view('quote.approved', compact('quote', 'acceptedOption', 'member', 'travelAgency'));

        // load regular view for selecting option
        return view('quote.index', compact('options', 'quote', 'member', 'travelAgency'));
    }

    /**
     * @param CreateTravelerRequest $request
     * @param IQuoteRepository $quoteRepository
     * @param IMemberTravelerRepository $memberTravelerRepository
     * @param IPostSaleTravelerRepository $postSaleTravelerRepository
     * @return mixed
     * @throws InternalErrorException
     */
    public function saveTraveler(CreateTravelerRequest $request, IQuoteRepository $quoteRepository,
                                 IMemberTravelerRepository $memberTravelerRepository, IPostSaleTravelerRepository $postSaleTravelerRepository)
    {
        // Get all the data being sent
        $data = $request->all();

        // Select the quote, no need to validate the quote because the token is being validated on the request rules.
        $quote = $quoteRepository->getEntity()->where('token', '=', $request->get('token'))->get()->first();

        // Add the member id to the data
        $data['member_id'] = $quote->member()->get()->first()->member_id;

        // Create the traveler
        if( ! $traveler = $memberTravelerRepository->getEntity()->create($data))
            throw new InternalErrorException(new \Exception("Sorry, we could not create the traveler; if the error continues, contact technical support."));

        // Create post sale traveler data
        $postSaleTravelerData = [
            'quote_id'     =>  $quote->quote_id,
            'traveler_id'   =>  $traveler->traveler_id,
        ];

        // Assign traveler to the post sale traveler
        if( ! $postSaleTravelerRepository->getEntity()->create($postSaleTravelerData) )
            throw new InternalErrorException(new \Exception("Sorry, we created the traveler, but we could not assign it to the booking; if the error continues, contact technical support."));

        return \Redirect::route('quote.secondStep', $data['token']);
    }

    /**
     * @param CreateCreditCardRequest $request
     * @param Authorize $authorize
     * @return mixed
     */
    public function saveCreditCard(CreateCreditCardRequest $request, Authorize $authorize)
    {
        // To use testing uncomment the following line
        $authorize = new Authorize($test = true);

        $customerProfileId = $authorize->createPaymentProfile($request->all());
        if($customerProfileId <= 0)
            return \Redirect::back()->withInput()->withErrors(['response_error' => "We could not save the credit card information. If the error continue, please contact technical support."]);

        return \Redirect::route('quote.secondStep', $request->get('token'));
    }

    /**
     * @param $token
     * @param IQuoteRepository $quoteRepository
     * @param IMemberCustomerProfileRepository $memberCustomerProfileRepository
     * @return \Illuminate\View\View
     * @throws InternalErrorException
     * @throws UnknownModelException
     */
    public function secondStep($token, IQuoteRepository $quoteRepository, IMemberCustomerProfileRepository $memberCustomerProfileRepository)
    {
        // Select quote
        $quote = $quoteRepository->getEntity()->where('token', '=', $token)->get()->first();
        // Check the quote is not empty
        if( ! $quote instanceof Quote)
            throw new UnknownModelException(new \Exception('The quote you are looking for does not exist.'));

        // Validate if the quote has an approved option
        $quoteOption = $quote->quoteOptions()->get()->filter(function($item) { return $item->selected == 'y'; })->first();
        if( ! $quoteOption instanceof QuoteOption)
            throw new InternalErrorException(new \Exception("Sorry, the quote you are looking haven't been approved yet."));

        // Select post sale
        $postSale = $quote->postSale()->get()->first();
        // Check post sale exists
        if( ! $postSale instanceof PostSale)
            return view('quote.create_post_sale', compact('quote'));

        // Select travelers
        $travelers = new Collection();
        $travelers_id = [];
        $customerProfileTravelers[""] = "Select one..."; // Add placeholder option
        foreach ($postSale->postSaleTravelers()->get()->all() as $postSaleTraveler)
        {
            $traveler = $postSaleTraveler->memberTraveler()->get()->first();
            $travelers->push($traveler);
            $customerProfileTravelers[$traveler->traveler_id] = $traveler->prefix.' '.$traveler->first_name.' '.$traveler->middle_name.' '.$traveler->last_name;
            $travelers_id[] = $traveler->traveler_id;
        }

        // Select quote member
        $member = $quote->member()->get()->first();

        // Select Travel Agency
        $travelAgency = $member->agency()->get()->first();

        // Select Profiles (Customers) and take them out from available options to create new ones
        $customerProfiles = $memberCustomerProfileRepository->getEntity()->where('member_id', '=', $member->member_id)->whereIn('traveler_id', $travelers_id)->get();
        foreach($customerProfiles->all() as $customerProfile)
            unset($customerProfileTravelers[$customerProfile->traveler_id]);

        return view('quote.second_step', compact('member', 'travelAgency', 'travelers', 'customerProfileTravelers', 'quote', 'customerProfiles'));
    }

}
