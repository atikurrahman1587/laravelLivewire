<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Item extends Model
{
    use HasFactory;
    protected static $item;
    protected $fillable = ['name', 'price', 'status'];

    protected static function SaveBasicInfo($item, $request): void
    {
        $item->user_id = Auth::id();
        $item->name = $request['name'];
        $item->price = $request['price'];
        $item->status = $request['status'] ? 1 : 0;
        $item->save();
    }
    public static function newItem($request): void
    {
        self::SaveBasicInfo(new self(), $request);
    }
    public static function updateItem($request, $id): void
    {
        self::SaveBasicInfo(self::query()->find($id), $request);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', '=', 1);
    }
}
