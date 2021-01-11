<?php

namespace Volc\Service;

use Volc\Base\V4Curl;
use GuzzleHttp\Client;

const ResourceServiceIdTRN = "trn:ImageX:*:*:ServiceId/%s";

class ImageX extends V4Curl
{
    protected function getConfig(string $region)
    {
        switch ($region) {
            case 'cn-north-1':
                $config = [
                    'host' => 'https://imagex.volcengineapi.com',
                    'config' => [
                        'timeout' => 5.0,
                        'headers' => [
                            'Accept' => 'application/json'
                        ],
                        'v4_credentials' => [
                            'region' => 'cn-north-1',
                            'service' => 'ImageX',
                        ],
                    ],
                ];
                break;
            case 'ap-singapore-1':
                $config = [
                    'host' => 'https://imagex-ap-singapore-1.volcengineapi.com',
                    'config' => [
                        'timeout' => 5.0,
                        'headers' => [
                            'Accept' => 'application/json'
                        ],
                        'v4_credentials' => [
                            'region' => 'ap-singapore-1',
                            'service' => 'ImageX',
                        ],
                    ],
                ];
                break;
            case 'us-east-1':
                $config = [
                    'host' => 'https://imagex-us-east-1.volcengineapi.com',
                    'config' => [
                        'timeout' => 5.0,
                        'headers' => [
                            'Accept' => 'application/json'
                        ],
                        'v4_credentials' => [
                            'region' => 'us-east-1',
                            'service' => 'ImageX',
                        ],
                    ],
                ];
                break;
            default:
                throw new \Exception(sprintf("ImageX not support region, %s", $region));
        }
        return $config;
    }

    protected $apiList = [
        'ApplyImageUpload' => [
            'url' => '/',
            'method' => 'get',
            'config' => [
                'query' => [
                    'Action' => 'ApplyImageUpload',
                    'Version' => '2018-08-01',
                ],
            ]
        ],
        'CommitImageUpload' => [
            'url' => '/',
            'method' => 'post',
            'config' => [
                'query' => [
                    'Action' => 'CommitImageUpload',
                    'Version' => '2018-08-01',
                ],
            ]
        ],
        'UpdateImageUploadFiles' => [
            'url' => '/',
            'method' => 'post',
            'config' => [
                'query' => [
                    'Action' => 'UpdateImageUploadFiles',
                    'Version' => '2018-08-01',
                ],
            ]
        ],
        'DeleteImageUploadFiles' => [
            'url' => '/',
            'method' => 'post',
            'config' => [
                'query' => [
                    'Action' => 'DeleteImageUploadFiles',
                    'Version' => '2018-08-01',
                ],
            ]
        ],
        'GetImageUploadFiles' => [
            'url' => '/',
            'method' => 'get',
            'config' => [
                'query' => [
                    'Action' => 'GetImageUploadFiles',
                    'Version' => '2018-08-01',
                ],
            ]
        ],
        'GetImageUploadFile' => [
            'url' => '/',
            'method' => 'get',
            'config' => [
                'query' => [
                    'Action' => 'GetImageUploadFile',
                    'Version' => '2018-08-01',
                ],
            ]
        ],
    ];

    public function applyUploadImage(array $query)
    {
        $response = $this->request('ApplyImageUpload', $query);
        return (string) $response->getBody();
    }

    public function commitUploadImage(array $query)
    {
        $response = $this->request('CommitImageUpload', $query);
        return (string) $response->getBody();
    }

    public function updateImageUrls($serviceID, $urls, $action = 0)
    {
        if ($action < 0 || $action > 2)
        {
            throw new \Exception(sprintf("update action should be [0,2], %d", $action));
        }
        $config = [
            "query" => ["ServiceId" => $serviceID],
            "json" => [
                "Action" => $action,
                "ImageUrls" => $urls,
            ],
        ];
        $response = $this->request('UpdateImageUploadFiles', $config);
        return (string)$response->getBody();
    }

    public function upload(string $uploadHost, $storeInfo, string $filePath)
    {
        if (!file_exists($filePath)) {
            return -1;
        }
        $content = file_get_contents($filePath);
        $crc32 = dechex(crc32($content));

        $body = fopen($filePath, "r");
        $tosClient = new Client([
            'base_uri' => "https://" . $uploadHost,
            'timeout' => 5.0,
        ]);

        $response = $tosClient->request('PUT', $storeInfo["StoreUri"], ["body" => $body, "headers" => ['Authorization' => $storeInfo["Auth"], 'Content-CRC32' => $crc32]]);
        $uploadResponse = json_decode((string) $response->getBody(), true);
        if (!isset($uploadResponse["success"]) || $uploadResponse["success"] != 0) {
            return -2;
        }
        return 0;
    }

    public function uploadImages(array $params = [], array $filePaths = [])
    {
        if (!isset($params["ServiceId"])) {
            return "uploadImages: no ServiceId found";
        }
        $params["UploadNum"] = count($filePaths);

        $applyParams = array();
        $applyParams["Action"] = "ApplyImageUpload";
        $applyParams["Version"] = "2018-08-01";
        $applyParams["ServiceId"] = $params["ServiceId"];
        if (isset($params["SessionKey"])) {
            $applyParams["SessionKey"] = $params["SessionKey"];
        }
        $applyParams["UploadNum"] = $params["UploadNum"];
        if (isset($params["StoreKeys"]) && count($params["StoreKeys"]) != $params["UploadNum"]) {
            return "uploadImages: no StoreKeys found or StoreKeys size is unmatch";
        }
        $applyParams["StoreKeys"] = array();
        $queryStr = http_build_query($applyParams);
        foreach ($params["StoreKeys"] as $key => $value) {
            $queryStr = $queryStr . "&StoreKeys=" . urlencode($value);
        }

        $response = $this->applyUploadImage(['query' => $queryStr]);
        $applyResponse = json_decode($response, true);
        if (isset($applyResponse["ResponseMetadata"]["Error"])) {
            return sprintf("uploadImages: request id %s error %s", $applyResponse["ResponseMetadata"]["RequestId"], $applyResponse["ResponseMetadata"]["Error"]["Message"]);
        }

        $uploadAddr = $applyResponse['Result']['UploadAddress'];
        if (count($uploadAddr['UploadHosts']) == 0) {
            return "uploadImages: no upload host found";
        }
        $uploadHost = $uploadAddr['UploadHosts'][0];
        if (count($uploadAddr['StoreInfos']) != $params["UploadNum"]) {
            return "uploadImages: store infos num != upload num";
        }

        for ($i = 0; $i < count($filePaths); ++$i) {
            $respCode = $this->upload($uploadHost, $uploadAddr['StoreInfos'][$i], $filePaths[$i]);
            if ($respCode != 0) {
                return "upload " . $filePaths[$i] . " error";
            }
        }

        $commitParams = array();
        $commitParams["ServiceId"] = $params["ServiceId"];
        if (isset($params["SkipMeta"])) {
            $commitParams["SkipMeta"] = $params["SkipMeta"];
        }
        $commitBody = array();
        $commitBody["SessionKey"] = $uploadAddr['SessionKey'];
        if (isset($params["OptionInfos"])) {
            $commitBody["OptionInfos"] = $params["OptionInfos"];
        }
        if (isset($params["Functions"])) {
            $commitBody["Functions"] = $params["Functions"];
        }
        $commitReq = [
            "query" => $commitParams,
            "json" => $commitBody,
        ];

        $response = $this->commitUploadImage($commitReq);
        return (string) $response;
    }

    public function getUploadAuthToken($query)
    {
        $token = [
            "Version" => 'v1',
        ];

        $url = $this->getRequestUrl("ApplyImageUpload", $query);
        $m = parse_url($url);
        $token["ApplyUploadToken"] = $m["query"];

        $url = $this->getRequestUrl("CommitImageUpload", $query);
        $m = parse_url($url);
        $token["CommitUploadToken"] = $m["query"];

        return base64_encode(json_encode($token));
    }

    public function getUploadAuth(array $serviceIDList, int $expire = 3600)
    {
        $actions = ['ImageX:ApplyImageUpload', 'ImageX:CommitImageUpload'];
        $resources = [];
        if (sizeof($serviceIDList) == 0)
        {
            $resources[] = sprintf(ResourceServiceIdTRN, "*");
        }
        else
        {
            foreach ($serviceIDList as $serviceID)
            {
                $resources[] = sprintf(ResourceServiceIdTRN, $serviceID);
            }
        }

        $statement = $this->newAllowStatement($actions, $resources);
        $policy = [
            'Statement' => [$statement],
        ];

        return $this->signSts2($policy, $expire);
    }

    public function deleteImages(string $serviceID, array $uris = [])
    {
        $response = $this->request('DeleteImageUploadFiles', ['query' => ['ServiceId' => $serviceID], 'json' => ['StoreUris' => $uris]]);
        return (string)$response->getBody();
    }

    public function getImageUploadFiles(string $serviceID, string $fnamePrefix = null, int $offset = 0, int $limit = 1, int $marker = 0)
    {
        $applyParams = [];
        $applyParams["Action"] = "GetImageUploadFiles";
        $applyParams["Version"] = "2018-08-01";
        $applyParams["ServiceId"] = $serviceID;

        if ($fnamePrefix != null) $applyParams["FnamePrefix"] = $fnamePrefix;
        $applyParams["Offset"] = $offset;
        $applyParams["Limit"] = $limit;
        $applyParams["Marker"] = $marker;

        $queryStr = http_build_query($applyParams);

        $response = $this->request('GetImageUploadFiles', ['query' => $queryStr]);
        return (string) $response->getBody();
    }

    public function getImageUploadFile(string $serviceID, string $storeUri = null)
    {
        $applyParams = [];
        $applyParams["Action"] = "GetImageUploadFile";
        $applyParams["Version"] = "2018-08-01";
        $applyParams["ServiceId"] = $serviceID;

        $applyParams["StoreUri"] = $storeUri;

        $queryStr = http_build_query($applyParams);

        $response = $this->request('GetImageUploadFile', ['query' => $queryStr]);
        return (string) $response->getBody();
    }
}
