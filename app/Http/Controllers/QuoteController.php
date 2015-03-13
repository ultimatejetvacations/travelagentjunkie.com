<?php namespace App\Http\Controllers;

use App\Entities\Contracts\IQuote;
use App\Exceptions\CustomExceptions\InternalErrorException;
use App\Exceptions\CustomExceptions\UnknownModelException;
use App\Repositories\Contracts\IQuoteOptionRepository;
use App\Repositories\Contracts\IQuoteRepository;

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
     * @param IQuoteRepository $quoteRepository
     * @param IQuoteOptionRepository $quoteOptionRepository
     * @param string $token
     * @return \Illuminate\View\View
     */
	public function quote(IQuoteRepository $quoteRepository, IQuoteOptionRepository $quoteOptionRepository, $token)
	{
        // Select quote based on token
        $quote = $quoteRepository->getEntity()->where('token', '=', $token)->get()->first();

        // Check the quote is not empty
        if( ! $quote instanceof IQuote)
            throw new UnknownModelException(new \Exception('The quote you are looking for does not exist.'));

        // Select the options for the quote
        $options = $quote->quoteOptions()->where('hidden', '=', 0)->orderBy('position')->get();

        if(count($options->all()) < 1)
            throw new InternalErrorException(new \Exception('Sorry the quote you are looking for does not have options.'));

		return view('quote.index', compact('options'));
	}

}