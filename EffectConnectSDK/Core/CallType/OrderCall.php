<?php
    namespace EffectConnectSDK\Core\CallType;

    use EffectConnectSDK\ApiCall;
    use EffectConnectSDK\Core\Interfaces\CallTypeInterface;
    use EffectConnectSDK\Core\Model\Order;
    use EffectConnectSDK\Core\Validation\OrderValidator;

    /**
     * Class ProductCall
     *
     * @author  Stefan Van den Heuvel
     * @company Koek & Peer
     * @product EffectConnect
     * @package EffectConnectSDK
     *
     * @method ApiCall create(Order $order)
     * @method ApiCall read($id)
     * @method ApiCall update(Order $order)
     */
    final class OrderCall extends AbstractCall implements CallTypeInterface
    {
        protected $validatorClass = OrderValidator::class;

        /**
         * @return ApiCall
         */
        public function prepareCall()
        {
            $apiCall = new ApiCall();
            $method  = false;
            $uri     = '/orders';
            $apiCall
                ->setResponseType($this->responseType)
                ->setResponseLanguage($this->responseLanguage)
                ->setCallType($this->callType)
                ->setCallDate($this->callDate)
                ->setPublicKey($this->keychain->getPublicKey())
                ->setSecretKey($this->keychain->getSecretKey())
                ->setPayload($this->payload)
            ;
            switch ($this->action)
            {
                case CallTypeInterface::ACTION_READ:
                    $method = 'GET';
                    break;
                case CallTypeInterface::ACTION_CREATE:
                    $method = 'POST';
                    break;
                case CallTypeInterface::ACTION_UPDATE:
                    $method = 'PUT';
                    break;
            }
            $apiCall
                ->setUri($uri)
                ->setMethod($method)
            ;

            return $apiCall;
        }
    }