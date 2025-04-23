<?php

namespace App\Http\Controllers;

use App\Models\Campaign as CampaignModel;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;

class Campaign extends Controller
{

    private $_campaignModel;

    public function __construct() {
        $this->_campaignModel = new CampaignModel();
    }

    public function campaignList() {
        $list = $this->_campaignModel->getCampaigns();
        $response = ['data' => $list];
        return Response($response);
    }

    public function createCampaign() {
        $validate = $this->validateCampaign();
        if($validate->fails()) {
            return Response(json_encode(['errors' => $validate->errors()->all()]), 400);
        }
        $blnResponse = $this->_campaignModel->createCampaign(Request::all());
        if($blnResponse) {
            return Response(json_encode(["data" => 'Campaign Created']), 200);
        }
        else {
            return Response(json_encode(["error" => 'Pleas request after some time.']), 422);
        }
    }

    public function shareCampaign($id) {
        if(empty($id)) {
            return Response('Please send the valid Parameters', 400);
        }

        $campaign = $this->_campaignModel->getCampaignById($id);
        if(!empty($campaign)) {
            Log::info('Campaign Exists and the It\'s been shared');
            return Response('Campaign Posted Successfully.');
        }
        return Response('Please send the valid Campaign ID.', 404);
    }

    private function validateCampaign() {
        $validate = Validator::make(Request::all(), [
            'title' => 'required|string',
            'description' => 'required|string',
            'targetLink' => 'required|url:https|regex:/^https:\/\/[a-z0-9.-]+\.[a-z]{2,}(\/.*)?$/i',
            'scheduleDate' => 'required|date_format:Y-m-d|after:today'
        ]);
        return $validate;
    }

    public function updateCampaign() {
        $validate = $this->validateCampaign();

        $validate->sometimes('campaignId', 'required|integer', function($request) {
            return property_exists($request, 'campaignId');
        });
        if($validate->fails()) {
            return Response(json_encode(['errors' => $validate->errors()->all()]), 400);
        }
        $params = Request::all();
        $campaignId = $params['campaignId'];
        $details = $this->_campaignModel->getCampaignById($campaignId);
        if(empty($details)) {
            return Response(json_encode(['errors' => 'Please send the valid campaign.']), 400);
        }
        $result = $this->_campaignModel->updateCampaign($params);
        if($result) {
            return Response(json_encode(["data" => 'Campaign Updated']));
        }
        return Response(json_encode(['errors' => 'There was some error while updating the Campaign']), 422);
    }

    public function deleteCampaign($id) {
        if(empty($id)) {
            return Response('Please send the valid Parameters', 400);
        }
        $details = $this->_campaignModel->getCampaignById($id);
        if(empty($details)) {
            return Response(json_encode(['errors' => 'Please send the valid campaign.']), 400);
        }
        $result = $this->_campaignModel->deleteCampaign($id);
        if($result) {
            return Response(json_encode(["data" => 'Campaign Deleted']));
        }
        return Response(json_encode(['errors' => 'There was some error while deleting the Campaign']), 422);
    }
}
