<?php

return [
    'api_key' => env('LOQATE_API_KEY'),

    'url' => 'https://api.addressy.com/',

    'requests' => [
        'find' => 'Capture/Interactive/Find/v1.1/',

        'retrieve' => 'Capture/Interactive/Retrieve/v1/',

        'verifyBankAccount' => 'BankAccountValidation/Interactive/Validate/v2.00/',

        'retrieveBySortcode' => 'BankAccountValidation/Interactive/RetrieveBySortcode/v1/',
    ],

    'endpoint' => [
        'csv' => 'csv.ws?',
        'dataset' => 'dataset.ws?',
        'file' => 'file.ws?',
        'htmltable' => 'htmltable.ws?',
        'image' => 'image.ws?',
        'json' => 'json3.ws?',
        'json-extra' => 'json3ex.ws?',
        'jsonp' => 'json2.ws?',
        'pdf' => 'pdf.ws?',
        'psv' => 'psv.ws?',
        'recordset' => 'recordset.ws?',
        'tsv' => 'tsv.ws?',
        'xml' => 'xmle.ws?',
        'xmla' => 'xmla.ws?',
    ],
];
