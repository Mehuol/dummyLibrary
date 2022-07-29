<?php
namespace dummyLibrary;

class CONFIG {
    
    function config(){ 
        
        return array (
            'logUrl' => './error_logs.log',
            'baseUrl' => 'https://staging.simpaisa.com/v2/',
            'initiateUrl' => 'wallets/transaction/initiate',
            'verifyUrl' => 'wallets/transaction/verify',
        );
        $conf;
    }

};

// return array(
//     'initiateUrl' => 'https://staging.simpaisa.com/v2/wallets/transaction/initiate',
//     'verifyUrl' => 'https://staging.simpaisa.com/v2/wallets/transaction/verify',
// );




