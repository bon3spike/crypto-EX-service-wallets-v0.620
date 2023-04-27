<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/call_back/create' => [[['_route' => 'app_call_back_create', '_controller' => 'App\\Controller\\CallBackController::index'], null, ['POST' => 0], null, false, false, null]],
        '/api/call_back' => [[['_route' => 'app_call_back', '_controller' => 'App\\Controller\\CallBackController::callBackList'], null, ['GET' => 0], null, true, false, null]],
        '/api/call_back/current' => [[['_route' => 'app_call_back_cur', '_controller' => 'App\\Controller\\CallBackController::callBackListID'], null, ['GET' => 0], null, false, false, null]],
        '/api/call_back/delete' => [[['_route' => 'app_call_back_dell', '_controller' => 'App\\Controller\\CallBackController::callBackListDel'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/certificate/get' => [[['_route' => 'app_certificate_get', '_controller' => 'App\\Controller\\CertificateController::getCertificate'], null, ['GET' => 0], null, false, false, null]],
        '/api/certificate/changevisible' => [[['_route' => 'app_certificate_changevisible', '_controller' => 'App\\Controller\\CertificateController::changeVisibleCertificate'], null, ['PATCH' => 0], null, false, false, null]],
        '/api/certificate/changetext' => [[['_route' => 'app_certificate_changetext', '_controller' => 'App\\Controller\\CertificateController::changeTextCertificate'], null, ['PATCH' => 0], null, false, false, null]],
        '/api/commission' => [[['_route' => 'app_commission', '_controller' => 'App\\Controller\\CommissionController::takeWalletsWithCurrentCurrency'], null, ['PATCH' => 0], null, false, false, null]],
        '/api/commission/get' => [[['_route' => 'app_commission_get', '_controller' => 'App\\Controller\\CommissionController::getCommission'], null, ['GET' => 0], null, false, false, null]],
        '/api/dashboard' => [[['_route' => 'api_dashboard', '_controller' => 'App\\Controller\\DashboardController::index'], null, null, null, false, false, null]],
        '/api/exchange/create' => [[['_route' => 'app_exchange_create', '_controller' => 'App\\Controller\\ExchangeController::create'], null, ['POST' => 0], null, false, false, null]],
        '/api/exchange/get' => [[['_route' => 'app_exchange_get', '_controller' => 'App\\Controller\\ExchangeController::getExOrder'], null, ['GET' => 0], null, false, false, null]],
        '/api/exchange/get_card' => [[['_route' => 'app_exchange_get_card', '_controller' => 'App\\Controller\\ExchangeController::cardExOrder'], null, ['GET' => 0], null, false, false, null]],
        '/api/exchange/get_card_input_output_transactions' => [[['_route' => 'app_exchange_get_card_input_output_transactions', '_controller' => 'App\\Controller\\ExchangeController::cardExOrderGetInputTransactions'], null, ['GET' => 0], null, false, false, null]],
        '/api/exchange/change_status_order' => [[['_route' => 'app_exchange_change_status_order', '_controller' => 'App\\Controller\\ExchangeController::cardExOrderChangeStatusId'], null, ['PATCH' => 0], null, false, false, null]],
        '/api/exchange/delete' => [[['_route' => 'app_exchange_delete', '_controller' => 'App\\Controller\\ExchangeController::cardExOrderDelete'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/exchange/input_transaction_create' => [[['_route' => 'app_exchange_input_transaction_create', '_controller' => 'App\\Controller\\ExchangeController::exchangeInputTransactionCreate'], null, ['POST' => 0], null, false, false, null]],
        '/api/exchange/output_transaction_create' => [[['_route' => 'app_exchange_output_transaction_create', '_controller' => 'App\\Controller\\ExchangeController::exchangeOutputTransactionCreate'], null, ['POST' => 0], null, false, false, null]],
        '/api/notification/get_notification' => [[['_route' => 'app_get_notification', '_controller' => 'App\\Controller\\GetNotificationController::getNotification'], null, ['GET' => 0], null, false, false, null]],
        '/api/message_login' => [[['_route' => 'app_message', '_controller' => 'App\\Controller\\LoginController::messageLogin'], null, ['POST' => 0], null, false, false, null]],
        '/api/message_check' => [[['_route' => 'app_message_check', '_controller' => 'App\\Controller\\LoginController::messageCheck'], null, ['POST' => 0], null, false, false, null]],
        '/api/mixing/order_create' => [[['_route' => 'app_mixing_order', '_controller' => 'App\\Controller\\MixingOrderController::createMixingOrder'], null, ['POST' => 0], null, false, false, null]],
        '/api/mixing/get_card' => [[['_route' => 'app_mixing_get_card', '_controller' => 'App\\Controller\\MixingOrderController::cardExOrder'], null, ['GET' => 0], null, false, false, null]],
        '/api/mixing/order_get_all' => [[['_route' => 'app_mixing_order_get', '_controller' => 'App\\Controller\\MixingOrderController::getMixingOrdersAll'], null, ['GET' => 0], null, false, false, null]],
        '/api/mixing/change_status_order' => [[['_route' => 'app_mixing_change_status_order', '_controller' => 'App\\Controller\\MixingOrderController::cardMixOrderChangeStatus'], null, ['PATCH' => 0], null, false, false, null]],
        '/api/mixing/delete' => [[['_route' => 'app_mixing_delete', '_controller' => 'App\\Controller\\MixingOrderController::cardMixOrderDelete'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/mixing/input_transaction_create' => [[['_route' => 'app_mixing_input_transaction_create', '_controller' => 'App\\Controller\\MixingOrderController::exchangeInputTransactionCreate'], null, ['POST' => 0], null, false, false, null]],
        '/api/mixing/output_transaction_create' => [[['_route' => 'app_mixing_output_transaction_create', '_controller' => 'App\\Controller\\MixingOrderController::mixingOutputTransactionCreate'], null, ['POST' => 0], null, false, false, null]],
        '/api/mixing/get_card_input_output_transactions' => [[['_route' => 'app_mixing_get_card_input_output_transactions', '_controller' => 'App\\Controller\\MixingOrderController::cardExOrderGetInputTransactions'], null, ['GET' => 0], null, false, false, null]],
        '/api/notification' => [[['_route' => 'app_notification', '_controller' => 'App\\Controller\\NotificationController::index'], null, ['PATCH' => 0], null, false, false, null]],
        '/api/notification/get' => [[['_route' => 'app_notification_get', '_controller' => 'App\\Controller\\NotificationController::getNoti'], null, ['GET' => 0], null, false, false, null]],
        '/api/price/currencies' => [[['_route' => 'app_get_price_currencies', '_controller' => 'App\\Controller\\PriceController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/publications' => [[['_route' => 'app_publications', '_controller' => 'App\\Controller\\PublicationsController::index'], null, ['PATCH' => 0, 'PUT' => 1, 'DELETE' => 2, 'POST' => 3], null, false, false, null]],
        '/api/publications/take' => [[['_route' => 'app_publications_take_add', '_controller' => 'App\\Controller\\PublicationsController::takeAllPublications'], null, ['GET' => 0], null, true, false, null]],
        '/api/register' => [[['_route' => 'app_registration', '_controller' => 'App\\Controller\\RegistrationController::index'], null, ['POST' => 0], null, false, false, null]],
        '/api/statistics' => [[['_route' => 'app_statistics', '_controller' => 'App\\Controller\\StatisticsController::index'], null, ['GET' => 0], null, false, false, null]],
        '/api/wallets/add/wallet' => [[['_route' => 'app_wallets_add_wallet', '_controller' => 'App\\Controller\\WalletsController::walletsAdd'], null, ['POST' => 0], null, false, false, null]],
        '/api/wallets/add/address' => [[['_route' => 'app_wallet_set_address_relation', '_controller' => 'App\\Controller\\WalletsController::addAddress'], null, ['POST' => 0], null, false, false, null]],
        '/api/wallets/get/currentchain' => [[['_route' => 'app_wallets_get_currentchain', '_controller' => 'App\\Controller\\WalletsController::takeWalletsWithCurrentCurrency'], null, ['GET' => 0], null, false, false, null]],
        '/api/wallets/information_for_delete' => [[['_route' => 'app_wallet_information_for_delete', '_controller' => 'App\\Controller\\WalletsController::DeleteWallet'], null, ['GET' => 0], null, false, false, null]],
        '/api/wallets/seedphrase_generation' => [[['_route' => 'app_wallets_seedphrase_generate', '_controller' => 'App\\Controller\\WalletsController::getRandomSeedPhraze'], null, ['GET' => 0], null, false, false, null]],
        '/api/wallets/delete_wallet' => [[['_route' => 'app_wallets_delete_wallet', '_controller' => 'App\\Controller\\WalletsController::index'], null, ['DELETE' => 0], null, false, false, null]],
        '/api/wallets/send/getEncryptedMessage' => [[['_route' => 'app_wallet_send_get_encrypted_message', '_controller' => 'App\\Controller\\WalletsController::getEncryptedMessage'], null, ['GET' => 0], null, false, false, null]],
        '/api/wallets/send/checkDecryptedMessage' => [[['_route' => 'app_testing', '_controller' => 'App\\Controller\\WalletsController::checkDecryptedMessage'], null, ['POST' => 0], null, false, false, null]],
        '/api/wallets/get_card' => [[['_route' => 'app_wallets_get_card', '_controller' => 'App\\Controller\\WalletsController::getWalletCard'], null, ['GET' => 0], null, false, false, null]],
        '/api/wallets/get_all_wallets' => [[['_route' => 'app_wallets_get_all_wallets', '_controller' => 'App\\Controller\\WalletsController::getAllWallets'], null, ['GET' => 0], null, false, false, null]],
        '/api/wallet/statistic/add' => [[['_route' => 'app_wallet_statistictest', '_controller' => 'App\\Controller\\WalletsStatisticController::getcurrencies'], null, ['GET' => 0], null, false, false, null]],
        '/api/login_check' => [[['_route' => 'api_login_check'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [
            [['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
