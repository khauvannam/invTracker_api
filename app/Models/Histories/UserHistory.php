<?php

namespace App\Models\Histories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Folders\Folder;
use App\Models\Items\Item;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\HasFactory; 


class UserHistory extends Model
{
  use HasFactory; 
  protected $fillable = [
    'user_id',
    'activity_type',
    'folder_id',
    'item_id',
  ];

  public function folder(){
    return $this->belongTo(Folder::class);
  }
  public function item(){
    return $this->belongTo(Item::class);
  }
  public function user(){
    return $this->belongTo(User::class);
  }
  
}

?>