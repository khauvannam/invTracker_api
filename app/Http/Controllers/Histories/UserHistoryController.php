<?php

namespace App\Http\Controllers\Histories;
use App\Models\Items;
use App\Models\Folders;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UserHistoryService;

class UserHistoryController extends Controller
{

protected UserHistoryService $service;

public function __construct( UserHistoryService $service){
    $this->service=$service;
}
    public function index(){ 

    $data=$this->service->show();
    return response()->json($data);
    
    }
}
