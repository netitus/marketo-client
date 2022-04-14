<?php

namespace Netitus\Marketo\Client\Response;

use Psr\Http\Message\ResponseInterface as PsrResponseInterface;

class AssetResponse extends RestResponse
{
    /** @var int */
    protected $assetId;
    /** @var string */
    protected $assetType;

    public function __construct(PsrResponseInterface $response)
    {
        parent::__construct($response);
        if ($this->isSuccessful()) {
            $this->assetId = $this->getResult()[0]['id'];
        }
    }

    public function getAssetId()
    {
        return $this->assetId;
    }
}
