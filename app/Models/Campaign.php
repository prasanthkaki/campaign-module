<?php

namespace App\Models;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Campaign
{
    protected $table = 'campaign';
    public $timestamps =  false;

    public function getCampaigns() {
        return DB::table('campaign')->get();
    }

    public function createCampaign($params) {
        $title = $params['title'];
        $description = $params['description'];
        $scheduled = $params['scheduleDate'];
        $link = $params['targetLink'];
        DB::beginTransaction();
        try {
            DB::table('campaign')->insert(['title' => $title, 'description' => $description, 'targetLink' => $link,
            'scheduleDate' => $scheduled]);
            DB::commit();
            return true;
        }
        catch(Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function getCampaignById($id) {
        return DB::table('campaign')->where(['id' => $id])->first();
    }

    public function updateCampaign($params) {
        $campaignId = $params['campaignId'];
        $title = $params['title'];
        $description = $params['description'];
        $scheduled = $params['scheduleDate'];
        $link = $params['targetLink'];
        DB::beginTransaction();
        try {
            DB::table('campaign')->where('id', $campaignId)->update(['title' => $title, 'description' => $description, 
                'targetLink' => $link, 'scheduleDate' => $scheduled, 'modifyDateTime' => now()]);
            DB::commit();
            return true;
        }
        catch(Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return false;
        }
    }

    public function deleteCampaign($id) {
        DB::beginTransaction();
        try {
            DB::table('campaign')->delete($id);
            DB::commit();
            return true;
        }
        catch(Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
            return false;
        }
    }
}
