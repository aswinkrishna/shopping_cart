<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'App\\Config\\Connection' => $baseDir . '/app/config/connection.php',
    'App\\Controllers\\CartController' => $baseDir . '/app/controllers/CartController.php',
    'App\\Controllers\\CommonController' => $baseDir . '/app/controllers/CommonController.php',
    'App\\Controllers\\PaymentController' => $baseDir . '/app/controllers/PaymentController.php',
    'App\\Controllers\\ProductController' => $baseDir . '/app/controllers/ProductController.php',
    'App\\Controllers\\UserController' => $baseDir . '/app/controllers/UserController.php',
    'App\\Libraries\\Cart' => $baseDir . '/app/libraries/Cart.php',
    'App\\Models\\CartModel' => $baseDir . '/app/models/CartModel.php',
    'ComposerAutoloaderInitf5f0078eae4f59c24511c2c9ded7d1ce' => $vendorDir . '/composer/autoload_real.php',
    'Composer\\Autoload\\ClassLoader' => $vendorDir . '/composer/ClassLoader.php',
    'Composer\\Autoload\\ComposerStaticInitf5f0078eae4f59c24511c2c9ded7d1ce' => $vendorDir . '/composer/autoload_static.php',
    'Composer\\InstalledVersions' => $vendorDir . '/composer/InstalledVersions.php',
    'Router' => $baseDir . '/Router.php',
    'Stripe\\Account' => $vendorDir . '/stripe/stripe-php/lib/Account.php',
    'Stripe\\AccountLink' => $vendorDir . '/stripe/stripe-php/lib/AccountLink.php',
    'Stripe\\AlipayAccount' => $vendorDir . '/stripe/stripe-php/lib/AlipayAccount.php',
    'Stripe\\ApiOperations\\All' => $vendorDir . '/stripe/stripe-php/lib/ApiOperations/All.php',
    'Stripe\\ApiOperations\\Create' => $vendorDir . '/stripe/stripe-php/lib/ApiOperations/Create.php',
    'Stripe\\ApiOperations\\Delete' => $vendorDir . '/stripe/stripe-php/lib/ApiOperations/Delete.php',
    'Stripe\\ApiOperations\\NestedResource' => $vendorDir . '/stripe/stripe-php/lib/ApiOperations/NestedResource.php',
    'Stripe\\ApiOperations\\Request' => $vendorDir . '/stripe/stripe-php/lib/ApiOperations/Request.php',
    'Stripe\\ApiOperations\\Retrieve' => $vendorDir . '/stripe/stripe-php/lib/ApiOperations/Retrieve.php',
    'Stripe\\ApiOperations\\Search' => $vendorDir . '/stripe/stripe-php/lib/ApiOperations/Search.php',
    'Stripe\\ApiOperations\\Update' => $vendorDir . '/stripe/stripe-php/lib/ApiOperations/Update.php',
    'Stripe\\ApiRequestor' => $vendorDir . '/stripe/stripe-php/lib/ApiRequestor.php',
    'Stripe\\ApiResource' => $vendorDir . '/stripe/stripe-php/lib/ApiResource.php',
    'Stripe\\ApiResponse' => $vendorDir . '/stripe/stripe-php/lib/ApiResponse.php',
    'Stripe\\ApplePayDomain' => $vendorDir . '/stripe/stripe-php/lib/ApplePayDomain.php',
    'Stripe\\ApplicationFee' => $vendorDir . '/stripe/stripe-php/lib/ApplicationFee.php',
    'Stripe\\ApplicationFeeRefund' => $vendorDir . '/stripe/stripe-php/lib/ApplicationFeeRefund.php',
    'Stripe\\Apps\\Secret' => $vendorDir . '/stripe/stripe-php/lib/Apps/Secret.php',
    'Stripe\\Balance' => $vendorDir . '/stripe/stripe-php/lib/Balance.php',
    'Stripe\\BalanceTransaction' => $vendorDir . '/stripe/stripe-php/lib/BalanceTransaction.php',
    'Stripe\\BankAccount' => $vendorDir . '/stripe/stripe-php/lib/BankAccount.php',
    'Stripe\\BaseStripeClient' => $vendorDir . '/stripe/stripe-php/lib/BaseStripeClient.php',
    'Stripe\\BaseStripeClientInterface' => $vendorDir . '/stripe/stripe-php/lib/BaseStripeClientInterface.php',
    'Stripe\\BillingPortal\\Configuration' => $vendorDir . '/stripe/stripe-php/lib/BillingPortal/Configuration.php',
    'Stripe\\BillingPortal\\Session' => $vendorDir . '/stripe/stripe-php/lib/BillingPortal/Session.php',
    'Stripe\\BitcoinReceiver' => $vendorDir . '/stripe/stripe-php/lib/BitcoinReceiver.php',
    'Stripe\\BitcoinTransaction' => $vendorDir . '/stripe/stripe-php/lib/BitcoinTransaction.php',
    'Stripe\\Capability' => $vendorDir . '/stripe/stripe-php/lib/Capability.php',
    'Stripe\\Card' => $vendorDir . '/stripe/stripe-php/lib/Card.php',
    'Stripe\\CashBalance' => $vendorDir . '/stripe/stripe-php/lib/CashBalance.php',
    'Stripe\\Charge' => $vendorDir . '/stripe/stripe-php/lib/Charge.php',
    'Stripe\\Checkout\\Session' => $vendorDir . '/stripe/stripe-php/lib/Checkout/Session.php',
    'Stripe\\Collection' => $vendorDir . '/stripe/stripe-php/lib/Collection.php',
    'Stripe\\CountrySpec' => $vendorDir . '/stripe/stripe-php/lib/CountrySpec.php',
    'Stripe\\Coupon' => $vendorDir . '/stripe/stripe-php/lib/Coupon.php',
    'Stripe\\CreditNote' => $vendorDir . '/stripe/stripe-php/lib/CreditNote.php',
    'Stripe\\CreditNoteLineItem' => $vendorDir . '/stripe/stripe-php/lib/CreditNoteLineItem.php',
    'Stripe\\Customer' => $vendorDir . '/stripe/stripe-php/lib/Customer.php',
    'Stripe\\CustomerBalanceTransaction' => $vendorDir . '/stripe/stripe-php/lib/CustomerBalanceTransaction.php',
    'Stripe\\Discount' => $vendorDir . '/stripe/stripe-php/lib/Discount.php',
    'Stripe\\Dispute' => $vendorDir . '/stripe/stripe-php/lib/Dispute.php',
    'Stripe\\EphemeralKey' => $vendorDir . '/stripe/stripe-php/lib/EphemeralKey.php',
    'Stripe\\ErrorObject' => $vendorDir . '/stripe/stripe-php/lib/ErrorObject.php',
    'Stripe\\Event' => $vendorDir . '/stripe/stripe-php/lib/Event.php',
    'Stripe\\Exception\\ApiConnectionException' => $vendorDir . '/stripe/stripe-php/lib/Exception/ApiConnectionException.php',
    'Stripe\\Exception\\ApiErrorException' => $vendorDir . '/stripe/stripe-php/lib/Exception/ApiErrorException.php',
    'Stripe\\Exception\\AuthenticationException' => $vendorDir . '/stripe/stripe-php/lib/Exception/AuthenticationException.php',
    'Stripe\\Exception\\BadMethodCallException' => $vendorDir . '/stripe/stripe-php/lib/Exception/BadMethodCallException.php',
    'Stripe\\Exception\\CardException' => $vendorDir . '/stripe/stripe-php/lib/Exception/CardException.php',
    'Stripe\\Exception\\ExceptionInterface' => $vendorDir . '/stripe/stripe-php/lib/Exception/ExceptionInterface.php',
    'Stripe\\Exception\\IdempotencyException' => $vendorDir . '/stripe/stripe-php/lib/Exception/IdempotencyException.php',
    'Stripe\\Exception\\InvalidArgumentException' => $vendorDir . '/stripe/stripe-php/lib/Exception/InvalidArgumentException.php',
    'Stripe\\Exception\\InvalidRequestException' => $vendorDir . '/stripe/stripe-php/lib/Exception/InvalidRequestException.php',
    'Stripe\\Exception\\OAuth\\ExceptionInterface' => $vendorDir . '/stripe/stripe-php/lib/Exception/OAuth/ExceptionInterface.php',
    'Stripe\\Exception\\OAuth\\InvalidClientException' => $vendorDir . '/stripe/stripe-php/lib/Exception/OAuth/InvalidClientException.php',
    'Stripe\\Exception\\OAuth\\InvalidGrantException' => $vendorDir . '/stripe/stripe-php/lib/Exception/OAuth/InvalidGrantException.php',
    'Stripe\\Exception\\OAuth\\InvalidRequestException' => $vendorDir . '/stripe/stripe-php/lib/Exception/OAuth/InvalidRequestException.php',
    'Stripe\\Exception\\OAuth\\InvalidScopeException' => $vendorDir . '/stripe/stripe-php/lib/Exception/OAuth/InvalidScopeException.php',
    'Stripe\\Exception\\OAuth\\OAuthErrorException' => $vendorDir . '/stripe/stripe-php/lib/Exception/OAuth/OAuthErrorException.php',
    'Stripe\\Exception\\OAuth\\UnknownOAuthErrorException' => $vendorDir . '/stripe/stripe-php/lib/Exception/OAuth/UnknownOAuthErrorException.php',
    'Stripe\\Exception\\OAuth\\UnsupportedGrantTypeException' => $vendorDir . '/stripe/stripe-php/lib/Exception/OAuth/UnsupportedGrantTypeException.php',
    'Stripe\\Exception\\OAuth\\UnsupportedResponseTypeException' => $vendorDir . '/stripe/stripe-php/lib/Exception/OAuth/UnsupportedResponseTypeException.php',
    'Stripe\\Exception\\PermissionException' => $vendorDir . '/stripe/stripe-php/lib/Exception/PermissionException.php',
    'Stripe\\Exception\\RateLimitException' => $vendorDir . '/stripe/stripe-php/lib/Exception/RateLimitException.php',
    'Stripe\\Exception\\SignatureVerificationException' => $vendorDir . '/stripe/stripe-php/lib/Exception/SignatureVerificationException.php',
    'Stripe\\Exception\\UnexpectedValueException' => $vendorDir . '/stripe/stripe-php/lib/Exception/UnexpectedValueException.php',
    'Stripe\\Exception\\UnknownApiErrorException' => $vendorDir . '/stripe/stripe-php/lib/Exception/UnknownApiErrorException.php',
    'Stripe\\ExchangeRate' => $vendorDir . '/stripe/stripe-php/lib/ExchangeRate.php',
    'Stripe\\File' => $vendorDir . '/stripe/stripe-php/lib/File.php',
    'Stripe\\FileLink' => $vendorDir . '/stripe/stripe-php/lib/FileLink.php',
    'Stripe\\FinancialConnections\\Account' => $vendorDir . '/stripe/stripe-php/lib/FinancialConnections/Account.php',
    'Stripe\\FinancialConnections\\AccountOwner' => $vendorDir . '/stripe/stripe-php/lib/FinancialConnections/AccountOwner.php',
    'Stripe\\FinancialConnections\\AccountOwnership' => $vendorDir . '/stripe/stripe-php/lib/FinancialConnections/AccountOwnership.php',
    'Stripe\\FinancialConnections\\Session' => $vendorDir . '/stripe/stripe-php/lib/FinancialConnections/Session.php',
    'Stripe\\FundingInstructions' => $vendorDir . '/stripe/stripe-php/lib/FundingInstructions.php',
    'Stripe\\HttpClient\\ClientInterface' => $vendorDir . '/stripe/stripe-php/lib/HttpClient/ClientInterface.php',
    'Stripe\\HttpClient\\CurlClient' => $vendorDir . '/stripe/stripe-php/lib/HttpClient/CurlClient.php',
    'Stripe\\HttpClient\\StreamingClientInterface' => $vendorDir . '/stripe/stripe-php/lib/HttpClient/StreamingClientInterface.php',
    'Stripe\\Identity\\VerificationReport' => $vendorDir . '/stripe/stripe-php/lib/Identity/VerificationReport.php',
    'Stripe\\Identity\\VerificationSession' => $vendorDir . '/stripe/stripe-php/lib/Identity/VerificationSession.php',
    'Stripe\\Invoice' => $vendorDir . '/stripe/stripe-php/lib/Invoice.php',
    'Stripe\\InvoiceItem' => $vendorDir . '/stripe/stripe-php/lib/InvoiceItem.php',
    'Stripe\\InvoiceLineItem' => $vendorDir . '/stripe/stripe-php/lib/InvoiceLineItem.php',
    'Stripe\\Issuing\\Authorization' => $vendorDir . '/stripe/stripe-php/lib/Issuing/Authorization.php',
    'Stripe\\Issuing\\Card' => $vendorDir . '/stripe/stripe-php/lib/Issuing/Card.php',
    'Stripe\\Issuing\\CardDetails' => $vendorDir . '/stripe/stripe-php/lib/Issuing/CardDetails.php',
    'Stripe\\Issuing\\Cardholder' => $vendorDir . '/stripe/stripe-php/lib/Issuing/Cardholder.php',
    'Stripe\\Issuing\\Dispute' => $vendorDir . '/stripe/stripe-php/lib/Issuing/Dispute.php',
    'Stripe\\Issuing\\Transaction' => $vendorDir . '/stripe/stripe-php/lib/Issuing/Transaction.php',
    'Stripe\\LineItem' => $vendorDir . '/stripe/stripe-php/lib/LineItem.php',
    'Stripe\\LoginLink' => $vendorDir . '/stripe/stripe-php/lib/LoginLink.php',
    'Stripe\\Mandate' => $vendorDir . '/stripe/stripe-php/lib/Mandate.php',
    'Stripe\\OAuth' => $vendorDir . '/stripe/stripe-php/lib/OAuth.php',
    'Stripe\\OAuthErrorObject' => $vendorDir . '/stripe/stripe-php/lib/OAuthErrorObject.php',
    'Stripe\\Order' => $vendorDir . '/stripe/stripe-php/lib/Order.php',
    'Stripe\\OrderItem' => $vendorDir . '/stripe/stripe-php/lib/OrderItem.php',
    'Stripe\\PaymentIntent' => $vendorDir . '/stripe/stripe-php/lib/PaymentIntent.php',
    'Stripe\\PaymentLink' => $vendorDir . '/stripe/stripe-php/lib/PaymentLink.php',
    'Stripe\\PaymentMethod' => $vendorDir . '/stripe/stripe-php/lib/PaymentMethod.php',
    'Stripe\\Payout' => $vendorDir . '/stripe/stripe-php/lib/Payout.php',
    'Stripe\\Person' => $vendorDir . '/stripe/stripe-php/lib/Person.php',
    'Stripe\\Plan' => $vendorDir . '/stripe/stripe-php/lib/Plan.php',
    'Stripe\\Price' => $vendorDir . '/stripe/stripe-php/lib/Price.php',
    'Stripe\\Product' => $vendorDir . '/stripe/stripe-php/lib/Product.php',
    'Stripe\\PromotionCode' => $vendorDir . '/stripe/stripe-php/lib/PromotionCode.php',
    'Stripe\\Quote' => $vendorDir . '/stripe/stripe-php/lib/Quote.php',
    'Stripe\\Radar\\EarlyFraudWarning' => $vendorDir . '/stripe/stripe-php/lib/Radar/EarlyFraudWarning.php',
    'Stripe\\Radar\\ValueList' => $vendorDir . '/stripe/stripe-php/lib/Radar/ValueList.php',
    'Stripe\\Radar\\ValueListItem' => $vendorDir . '/stripe/stripe-php/lib/Radar/ValueListItem.php',
    'Stripe\\Recipient' => $vendorDir . '/stripe/stripe-php/lib/Recipient.php',
    'Stripe\\RecipientTransfer' => $vendorDir . '/stripe/stripe-php/lib/RecipientTransfer.php',
    'Stripe\\Refund' => $vendorDir . '/stripe/stripe-php/lib/Refund.php',
    'Stripe\\Reporting\\ReportRun' => $vendorDir . '/stripe/stripe-php/lib/Reporting/ReportRun.php',
    'Stripe\\Reporting\\ReportType' => $vendorDir . '/stripe/stripe-php/lib/Reporting/ReportType.php',
    'Stripe\\RequestTelemetry' => $vendorDir . '/stripe/stripe-php/lib/RequestTelemetry.php',
    'Stripe\\Review' => $vendorDir . '/stripe/stripe-php/lib/Review.php',
    'Stripe\\SKU' => $vendorDir . '/stripe/stripe-php/lib/SKU.php',
    'Stripe\\SearchResult' => $vendorDir . '/stripe/stripe-php/lib/SearchResult.php',
    'Stripe\\Service\\AbstractService' => $vendorDir . '/stripe/stripe-php/lib/Service/AbstractService.php',
    'Stripe\\Service\\AbstractServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/AbstractServiceFactory.php',
    'Stripe\\Service\\AccountLinkService' => $vendorDir . '/stripe/stripe-php/lib/Service/AccountLinkService.php',
    'Stripe\\Service\\AccountService' => $vendorDir . '/stripe/stripe-php/lib/Service/AccountService.php',
    'Stripe\\Service\\ApplePayDomainService' => $vendorDir . '/stripe/stripe-php/lib/Service/ApplePayDomainService.php',
    'Stripe\\Service\\ApplicationFeeService' => $vendorDir . '/stripe/stripe-php/lib/Service/ApplicationFeeService.php',
    'Stripe\\Service\\Apps\\AppsServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/Apps/AppsServiceFactory.php',
    'Stripe\\Service\\Apps\\SecretService' => $vendorDir . '/stripe/stripe-php/lib/Service/Apps/SecretService.php',
    'Stripe\\Service\\BalanceService' => $vendorDir . '/stripe/stripe-php/lib/Service/BalanceService.php',
    'Stripe\\Service\\BalanceTransactionService' => $vendorDir . '/stripe/stripe-php/lib/Service/BalanceTransactionService.php',
    'Stripe\\Service\\BillingPortal\\BillingPortalServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/BillingPortal/BillingPortalServiceFactory.php',
    'Stripe\\Service\\BillingPortal\\ConfigurationService' => $vendorDir . '/stripe/stripe-php/lib/Service/BillingPortal/ConfigurationService.php',
    'Stripe\\Service\\BillingPortal\\SessionService' => $vendorDir . '/stripe/stripe-php/lib/Service/BillingPortal/SessionService.php',
    'Stripe\\Service\\ChargeService' => $vendorDir . '/stripe/stripe-php/lib/Service/ChargeService.php',
    'Stripe\\Service\\Checkout\\CheckoutServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/Checkout/CheckoutServiceFactory.php',
    'Stripe\\Service\\Checkout\\SessionService' => $vendorDir . '/stripe/stripe-php/lib/Service/Checkout/SessionService.php',
    'Stripe\\Service\\CoreServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/CoreServiceFactory.php',
    'Stripe\\Service\\CountrySpecService' => $vendorDir . '/stripe/stripe-php/lib/Service/CountrySpecService.php',
    'Stripe\\Service\\CouponService' => $vendorDir . '/stripe/stripe-php/lib/Service/CouponService.php',
    'Stripe\\Service\\CreditNoteService' => $vendorDir . '/stripe/stripe-php/lib/Service/CreditNoteService.php',
    'Stripe\\Service\\CustomerService' => $vendorDir . '/stripe/stripe-php/lib/Service/CustomerService.php',
    'Stripe\\Service\\DisputeService' => $vendorDir . '/stripe/stripe-php/lib/Service/DisputeService.php',
    'Stripe\\Service\\EphemeralKeyService' => $vendorDir . '/stripe/stripe-php/lib/Service/EphemeralKeyService.php',
    'Stripe\\Service\\EventService' => $vendorDir . '/stripe/stripe-php/lib/Service/EventService.php',
    'Stripe\\Service\\ExchangeRateService' => $vendorDir . '/stripe/stripe-php/lib/Service/ExchangeRateService.php',
    'Stripe\\Service\\FileLinkService' => $vendorDir . '/stripe/stripe-php/lib/Service/FileLinkService.php',
    'Stripe\\Service\\FileService' => $vendorDir . '/stripe/stripe-php/lib/Service/FileService.php',
    'Stripe\\Service\\FinancialConnections\\AccountService' => $vendorDir . '/stripe/stripe-php/lib/Service/FinancialConnections/AccountService.php',
    'Stripe\\Service\\FinancialConnections\\FinancialConnectionsServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/FinancialConnections/FinancialConnectionsServiceFactory.php',
    'Stripe\\Service\\FinancialConnections\\SessionService' => $vendorDir . '/stripe/stripe-php/lib/Service/FinancialConnections/SessionService.php',
    'Stripe\\Service\\Identity\\IdentityServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/Identity/IdentityServiceFactory.php',
    'Stripe\\Service\\Identity\\VerificationReportService' => $vendorDir . '/stripe/stripe-php/lib/Service/Identity/VerificationReportService.php',
    'Stripe\\Service\\Identity\\VerificationSessionService' => $vendorDir . '/stripe/stripe-php/lib/Service/Identity/VerificationSessionService.php',
    'Stripe\\Service\\InvoiceItemService' => $vendorDir . '/stripe/stripe-php/lib/Service/InvoiceItemService.php',
    'Stripe\\Service\\InvoiceService' => $vendorDir . '/stripe/stripe-php/lib/Service/InvoiceService.php',
    'Stripe\\Service\\Issuing\\AuthorizationService' => $vendorDir . '/stripe/stripe-php/lib/Service/Issuing/AuthorizationService.php',
    'Stripe\\Service\\Issuing\\CardService' => $vendorDir . '/stripe/stripe-php/lib/Service/Issuing/CardService.php',
    'Stripe\\Service\\Issuing\\CardholderService' => $vendorDir . '/stripe/stripe-php/lib/Service/Issuing/CardholderService.php',
    'Stripe\\Service\\Issuing\\DisputeService' => $vendorDir . '/stripe/stripe-php/lib/Service/Issuing/DisputeService.php',
    'Stripe\\Service\\Issuing\\IssuingServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/Issuing/IssuingServiceFactory.php',
    'Stripe\\Service\\Issuing\\TransactionService' => $vendorDir . '/stripe/stripe-php/lib/Service/Issuing/TransactionService.php',
    'Stripe\\Service\\MandateService' => $vendorDir . '/stripe/stripe-php/lib/Service/MandateService.php',
    'Stripe\\Service\\OAuthService' => $vendorDir . '/stripe/stripe-php/lib/Service/OAuthService.php',
    'Stripe\\Service\\OrderService' => $vendorDir . '/stripe/stripe-php/lib/Service/OrderService.php',
    'Stripe\\Service\\PaymentIntentService' => $vendorDir . '/stripe/stripe-php/lib/Service/PaymentIntentService.php',
    'Stripe\\Service\\PaymentLinkService' => $vendorDir . '/stripe/stripe-php/lib/Service/PaymentLinkService.php',
    'Stripe\\Service\\PaymentMethodService' => $vendorDir . '/stripe/stripe-php/lib/Service/PaymentMethodService.php',
    'Stripe\\Service\\PayoutService' => $vendorDir . '/stripe/stripe-php/lib/Service/PayoutService.php',
    'Stripe\\Service\\PlanService' => $vendorDir . '/stripe/stripe-php/lib/Service/PlanService.php',
    'Stripe\\Service\\PriceService' => $vendorDir . '/stripe/stripe-php/lib/Service/PriceService.php',
    'Stripe\\Service\\ProductService' => $vendorDir . '/stripe/stripe-php/lib/Service/ProductService.php',
    'Stripe\\Service\\PromotionCodeService' => $vendorDir . '/stripe/stripe-php/lib/Service/PromotionCodeService.php',
    'Stripe\\Service\\QuoteService' => $vendorDir . '/stripe/stripe-php/lib/Service/QuoteService.php',
    'Stripe\\Service\\Radar\\EarlyFraudWarningService' => $vendorDir . '/stripe/stripe-php/lib/Service/Radar/EarlyFraudWarningService.php',
    'Stripe\\Service\\Radar\\RadarServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/Radar/RadarServiceFactory.php',
    'Stripe\\Service\\Radar\\ValueListItemService' => $vendorDir . '/stripe/stripe-php/lib/Service/Radar/ValueListItemService.php',
    'Stripe\\Service\\Radar\\ValueListService' => $vendorDir . '/stripe/stripe-php/lib/Service/Radar/ValueListService.php',
    'Stripe\\Service\\RefundService' => $vendorDir . '/stripe/stripe-php/lib/Service/RefundService.php',
    'Stripe\\Service\\Reporting\\ReportRunService' => $vendorDir . '/stripe/stripe-php/lib/Service/Reporting/ReportRunService.php',
    'Stripe\\Service\\Reporting\\ReportTypeService' => $vendorDir . '/stripe/stripe-php/lib/Service/Reporting/ReportTypeService.php',
    'Stripe\\Service\\Reporting\\ReportingServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/Reporting/ReportingServiceFactory.php',
    'Stripe\\Service\\ReviewService' => $vendorDir . '/stripe/stripe-php/lib/Service/ReviewService.php',
    'Stripe\\Service\\SetupAttemptService' => $vendorDir . '/stripe/stripe-php/lib/Service/SetupAttemptService.php',
    'Stripe\\Service\\SetupIntentService' => $vendorDir . '/stripe/stripe-php/lib/Service/SetupIntentService.php',
    'Stripe\\Service\\ShippingRateService' => $vendorDir . '/stripe/stripe-php/lib/Service/ShippingRateService.php',
    'Stripe\\Service\\Sigma\\ScheduledQueryRunService' => $vendorDir . '/stripe/stripe-php/lib/Service/Sigma/ScheduledQueryRunService.php',
    'Stripe\\Service\\Sigma\\SigmaServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/Sigma/SigmaServiceFactory.php',
    'Stripe\\Service\\SkuService' => $vendorDir . '/stripe/stripe-php/lib/Service/SkuService.php',
    'Stripe\\Service\\SourceService' => $vendorDir . '/stripe/stripe-php/lib/Service/SourceService.php',
    'Stripe\\Service\\SubscriptionItemService' => $vendorDir . '/stripe/stripe-php/lib/Service/SubscriptionItemService.php',
    'Stripe\\Service\\SubscriptionScheduleService' => $vendorDir . '/stripe/stripe-php/lib/Service/SubscriptionScheduleService.php',
    'Stripe\\Service\\SubscriptionService' => $vendorDir . '/stripe/stripe-php/lib/Service/SubscriptionService.php',
    'Stripe\\Service\\TaxCodeService' => $vendorDir . '/stripe/stripe-php/lib/Service/TaxCodeService.php',
    'Stripe\\Service\\TaxRateService' => $vendorDir . '/stripe/stripe-php/lib/Service/TaxRateService.php',
    'Stripe\\Service\\Terminal\\ConfigurationService' => $vendorDir . '/stripe/stripe-php/lib/Service/Terminal/ConfigurationService.php',
    'Stripe\\Service\\Terminal\\ConnectionTokenService' => $vendorDir . '/stripe/stripe-php/lib/Service/Terminal/ConnectionTokenService.php',
    'Stripe\\Service\\Terminal\\LocationService' => $vendorDir . '/stripe/stripe-php/lib/Service/Terminal/LocationService.php',
    'Stripe\\Service\\Terminal\\ReaderService' => $vendorDir . '/stripe/stripe-php/lib/Service/Terminal/ReaderService.php',
    'Stripe\\Service\\Terminal\\TerminalServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/Terminal/TerminalServiceFactory.php',
    'Stripe\\Service\\TestHelpers\\CustomerService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/CustomerService.php',
    'Stripe\\Service\\TestHelpers\\Issuing\\CardService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Issuing/CardService.php',
    'Stripe\\Service\\TestHelpers\\Issuing\\IssuingServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Issuing/IssuingServiceFactory.php',
    'Stripe\\Service\\TestHelpers\\RefundService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/RefundService.php',
    'Stripe\\Service\\TestHelpers\\Terminal\\ReaderService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Terminal/ReaderService.php',
    'Stripe\\Service\\TestHelpers\\Terminal\\TerminalServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Terminal/TerminalServiceFactory.php',
    'Stripe\\Service\\TestHelpers\\TestClockService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/TestClockService.php',
    'Stripe\\Service\\TestHelpers\\TestHelpersServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/TestHelpersServiceFactory.php',
    'Stripe\\Service\\TestHelpers\\Treasury\\InboundTransferService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Treasury/InboundTransferService.php',
    'Stripe\\Service\\TestHelpers\\Treasury\\OutboundPaymentService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Treasury/OutboundPaymentService.php',
    'Stripe\\Service\\TestHelpers\\Treasury\\OutboundTransferService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Treasury/OutboundTransferService.php',
    'Stripe\\Service\\TestHelpers\\Treasury\\ReceivedCreditService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Treasury/ReceivedCreditService.php',
    'Stripe\\Service\\TestHelpers\\Treasury\\ReceivedDebitService' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Treasury/ReceivedDebitService.php',
    'Stripe\\Service\\TestHelpers\\Treasury\\TreasuryServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/TestHelpers/Treasury/TreasuryServiceFactory.php',
    'Stripe\\Service\\TokenService' => $vendorDir . '/stripe/stripe-php/lib/Service/TokenService.php',
    'Stripe\\Service\\TopupService' => $vendorDir . '/stripe/stripe-php/lib/Service/TopupService.php',
    'Stripe\\Service\\TransferService' => $vendorDir . '/stripe/stripe-php/lib/Service/TransferService.php',
    'Stripe\\Service\\Treasury\\CreditReversalService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/CreditReversalService.php',
    'Stripe\\Service\\Treasury\\DebitReversalService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/DebitReversalService.php',
    'Stripe\\Service\\Treasury\\FinancialAccountService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/FinancialAccountService.php',
    'Stripe\\Service\\Treasury\\InboundTransferService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/InboundTransferService.php',
    'Stripe\\Service\\Treasury\\OutboundPaymentService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/OutboundPaymentService.php',
    'Stripe\\Service\\Treasury\\OutboundTransferService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/OutboundTransferService.php',
    'Stripe\\Service\\Treasury\\ReceivedCreditService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/ReceivedCreditService.php',
    'Stripe\\Service\\Treasury\\ReceivedDebitService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/ReceivedDebitService.php',
    'Stripe\\Service\\Treasury\\TransactionEntryService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/TransactionEntryService.php',
    'Stripe\\Service\\Treasury\\TransactionService' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/TransactionService.php',
    'Stripe\\Service\\Treasury\\TreasuryServiceFactory' => $vendorDir . '/stripe/stripe-php/lib/Service/Treasury/TreasuryServiceFactory.php',
    'Stripe\\Service\\WebhookEndpointService' => $vendorDir . '/stripe/stripe-php/lib/Service/WebhookEndpointService.php',
    'Stripe\\SetupAttempt' => $vendorDir . '/stripe/stripe-php/lib/SetupAttempt.php',
    'Stripe\\SetupIntent' => $vendorDir . '/stripe/stripe-php/lib/SetupIntent.php',
    'Stripe\\ShippingRate' => $vendorDir . '/stripe/stripe-php/lib/ShippingRate.php',
    'Stripe\\Sigma\\ScheduledQueryRun' => $vendorDir . '/stripe/stripe-php/lib/Sigma/ScheduledQueryRun.php',
    'Stripe\\SingletonApiResource' => $vendorDir . '/stripe/stripe-php/lib/SingletonApiResource.php',
    'Stripe\\Source' => $vendorDir . '/stripe/stripe-php/lib/Source.php',
    'Stripe\\SourceTransaction' => $vendorDir . '/stripe/stripe-php/lib/SourceTransaction.php',
    'Stripe\\Stripe' => $vendorDir . '/stripe/stripe-php/lib/Stripe.php',
    'Stripe\\StripeClient' => $vendorDir . '/stripe/stripe-php/lib/StripeClient.php',
    'Stripe\\StripeClientInterface' => $vendorDir . '/stripe/stripe-php/lib/StripeClientInterface.php',
    'Stripe\\StripeObject' => $vendorDir . '/stripe/stripe-php/lib/StripeObject.php',
    'Stripe\\StripeStreamingClientInterface' => $vendorDir . '/stripe/stripe-php/lib/StripeStreamingClientInterface.php',
    'Stripe\\Subscription' => $vendorDir . '/stripe/stripe-php/lib/Subscription.php',
    'Stripe\\SubscriptionItem' => $vendorDir . '/stripe/stripe-php/lib/SubscriptionItem.php',
    'Stripe\\SubscriptionSchedule' => $vendorDir . '/stripe/stripe-php/lib/SubscriptionSchedule.php',
    'Stripe\\TaxCode' => $vendorDir . '/stripe/stripe-php/lib/TaxCode.php',
    'Stripe\\TaxId' => $vendorDir . '/stripe/stripe-php/lib/TaxId.php',
    'Stripe\\TaxRate' => $vendorDir . '/stripe/stripe-php/lib/TaxRate.php',
    'Stripe\\Terminal\\Configuration' => $vendorDir . '/stripe/stripe-php/lib/Terminal/Configuration.php',
    'Stripe\\Terminal\\ConnectionToken' => $vendorDir . '/stripe/stripe-php/lib/Terminal/ConnectionToken.php',
    'Stripe\\Terminal\\Location' => $vendorDir . '/stripe/stripe-php/lib/Terminal/Location.php',
    'Stripe\\Terminal\\Reader' => $vendorDir . '/stripe/stripe-php/lib/Terminal/Reader.php',
    'Stripe\\TestHelpers\\TestClock' => $vendorDir . '/stripe/stripe-php/lib/TestHelpers/TestClock.php',
    'Stripe\\ThreeDSecure' => $vendorDir . '/stripe/stripe-php/lib/ThreeDSecure.php',
    'Stripe\\Token' => $vendorDir . '/stripe/stripe-php/lib/Token.php',
    'Stripe\\Topup' => $vendorDir . '/stripe/stripe-php/lib/Topup.php',
    'Stripe\\Transfer' => $vendorDir . '/stripe/stripe-php/lib/Transfer.php',
    'Stripe\\TransferReversal' => $vendorDir . '/stripe/stripe-php/lib/TransferReversal.php',
    'Stripe\\Treasury\\CreditReversal' => $vendorDir . '/stripe/stripe-php/lib/Treasury/CreditReversal.php',
    'Stripe\\Treasury\\DebitReversal' => $vendorDir . '/stripe/stripe-php/lib/Treasury/DebitReversal.php',
    'Stripe\\Treasury\\FinancialAccount' => $vendorDir . '/stripe/stripe-php/lib/Treasury/FinancialAccount.php',
    'Stripe\\Treasury\\FinancialAccountFeatures' => $vendorDir . '/stripe/stripe-php/lib/Treasury/FinancialAccountFeatures.php',
    'Stripe\\Treasury\\InboundTransfer' => $vendorDir . '/stripe/stripe-php/lib/Treasury/InboundTransfer.php',
    'Stripe\\Treasury\\OutboundPayment' => $vendorDir . '/stripe/stripe-php/lib/Treasury/OutboundPayment.php',
    'Stripe\\Treasury\\OutboundTransfer' => $vendorDir . '/stripe/stripe-php/lib/Treasury/OutboundTransfer.php',
    'Stripe\\Treasury\\ReceivedCredit' => $vendorDir . '/stripe/stripe-php/lib/Treasury/ReceivedCredit.php',
    'Stripe\\Treasury\\ReceivedDebit' => $vendorDir . '/stripe/stripe-php/lib/Treasury/ReceivedDebit.php',
    'Stripe\\Treasury\\Transaction' => $vendorDir . '/stripe/stripe-php/lib/Treasury/Transaction.php',
    'Stripe\\Treasury\\TransactionEntry' => $vendorDir . '/stripe/stripe-php/lib/Treasury/TransactionEntry.php',
    'Stripe\\UsageRecord' => $vendorDir . '/stripe/stripe-php/lib/UsageRecord.php',
    'Stripe\\UsageRecordSummary' => $vendorDir . '/stripe/stripe-php/lib/UsageRecordSummary.php',
    'Stripe\\Util\\ApiVersion' => $vendorDir . '/stripe/stripe-php/lib/Util/ApiVersion.php',
    'Stripe\\Util\\CaseInsensitiveArray' => $vendorDir . '/stripe/stripe-php/lib/Util/CaseInsensitiveArray.php',
    'Stripe\\Util\\DefaultLogger' => $vendorDir . '/stripe/stripe-php/lib/Util/DefaultLogger.php',
    'Stripe\\Util\\LoggerInterface' => $vendorDir . '/stripe/stripe-php/lib/Util/LoggerInterface.php',
    'Stripe\\Util\\ObjectTypes' => $vendorDir . '/stripe/stripe-php/lib/Util/ObjectTypes.php',
    'Stripe\\Util\\RandomGenerator' => $vendorDir . '/stripe/stripe-php/lib/Util/RandomGenerator.php',
    'Stripe\\Util\\RequestOptions' => $vendorDir . '/stripe/stripe-php/lib/Util/RequestOptions.php',
    'Stripe\\Util\\Set' => $vendorDir . '/stripe/stripe-php/lib/Util/Set.php',
    'Stripe\\Util\\Util' => $vendorDir . '/stripe/stripe-php/lib/Util/Util.php',
    'Stripe\\Webhook' => $vendorDir . '/stripe/stripe-php/lib/Webhook.php',
    'Stripe\\WebhookEndpoint' => $vendorDir . '/stripe/stripe-php/lib/WebhookEndpoint.php',
    'Stripe\\WebhookSignature' => $vendorDir . '/stripe/stripe-php/lib/WebhookSignature.php',
);
