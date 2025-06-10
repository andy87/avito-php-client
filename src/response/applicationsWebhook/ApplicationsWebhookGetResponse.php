<?php

namespace andy87\client\avito\response\applicationsWebhook;

use BaseClient\BaseResponse;
use BaseClient\ResponseInterface;
use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

/**
 * Response for the applications webhook info request.
 * Contains details about webhook subscriptions.
 */
class ApplicationsWebhookGetResponse extends BaseResponse implements ResponseInterface
{
    /**
     * The data payload of the webhook information.
     * This may contain subscription details, etc.
     */
    public $value;

    /**
     * Construct an ApplicationsWebhookResponse and parse the data.
     * @param PsrResponseInterface $response The raw HTTP response from webhook info request.
     */
    public function __construct(PsrResponseInterface $response)
    {
        parent::__construct($response);

        // Parse JSON body
        $body = $this->getBody();
        $data = json_decode($body);

        // If the response has a 'value' field, use it; otherwise, store the whole data
        if (isset($data->value)) {
            $this->value = $data->value;
        } else {
            $this->value = $data;
        }
    }
}
