<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: vod/business/vod_media.proto

namespace Volc\Models\Vod\Business;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>Volcengine.Models.Vod.Business.VodStoreUriGroup</code>
 */
class VodStoreUriGroup extends \Google\Protobuf\Internal\Message
{
    /**
     *视频ID
     *
     * Generated from protobuf field <code>string Vid = 1;</code>
     */
    protected $Vid = '';
    /**
     *封面图对象地址列表
     *
     * Generated from protobuf field <code>repeated string StoreUris = 2;</code>
     */
    private $StoreUris;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $Vid
     *          视频ID
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $StoreUris
     *          封面图对象地址列表
     * }
     */
    public function __construct($data = NULL) {
        \Volc\Models\Vod\GPBMetadata\VodMedia::initOnce();
        parent::__construct($data);
    }

    /**
     *视频ID
     *
     * Generated from protobuf field <code>string Vid = 1;</code>
     * @return string
     */
    public function getVid()
    {
        return $this->Vid;
    }

    /**
     *视频ID
     *
     * Generated from protobuf field <code>string Vid = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setVid($var)
    {
        GPBUtil::checkString($var, True);
        $this->Vid = $var;

        return $this;
    }

    /**
     *封面图对象地址列表
     *
     * Generated from protobuf field <code>repeated string StoreUris = 2;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getStoreUris()
    {
        return $this->StoreUris;
    }

    /**
     *封面图对象地址列表
     *
     * Generated from protobuf field <code>repeated string StoreUris = 2;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setStoreUris($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->StoreUris = $arr;

        return $this;
    }

}

