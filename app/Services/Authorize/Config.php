<?php namespace App\Services\Authorize;


class Config {

    /* Test Cards */
    // - American Express Test Card: 370000000000002
    // - Discover Test Card: 6011000000000012
    // - Visa Test Card: 4007000000027
    // - Second Visa Test Card: 4012888818888
    // - JCB: 3088000000000017
    // - Diners Club/ Carte Blanche: 38000000000006

    public function getCredentials()
    {
        return [
            "g_loginname"   =>  "55CbHy7UH8aK", // Keep this secure
            "g_transactionkey"  =>  "8J6b5L73q36J4XwA", // Keep this secure
            "g_apihost"         =>  "api.authorize.net",
            "g_apipath"         =>  "/xml/v1/request.api",
        ];
    }

    public function getTestCredentials()
    {
        return [
            "g_loginname"       =>  "5A53aU8uw", // Keep this secure
            "g_transactionkey"  =>  "32d4Y5e94M2x96D9", // Keep this secure
            "g_apihost"         =>  "apitest.authorize.net",
            "g_apipath"         =>  "/xml/v1/request.api",
        ];
    }

}