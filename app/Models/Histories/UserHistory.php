<?php

namespace App\Models\Histories;

use App\Models\Folders\Folder;
use App\Models\Items\Item;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UserHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'activity_type',
        'folder_id',
        'item_id',
    ];

    public function folder(): belongsTo
    {
        return $this->belongTo(Folder::class);
    }

    public function item(): belongsTo
    {
        return $this->belongTo(Item::class);
    }

    public function user(): belongsTo
    {
        return $this->belongTo(User::class);
    }

}

