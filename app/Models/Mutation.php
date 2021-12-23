<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutation extends Model
{
    const KREDIT = "KREDIT";
    const DEBIT = "DEBIT";

    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = ["id"];

    /**
     * create mutation user
     *
     * @param [int] $userId
     * @param [string] $value
     * @param [string] $type => KREDIT or DEBIT
     * @return boolean
     */
    static function createMutation(int $userId, int $value, string $type): bool
    {
        if ($type === self::KREDIT) {
            $totalBalanace = $value + self::lastBalance($userId);
            $data = [
                "user_id" => $userId,
                "value" => $value,
                "balance" => $totalBalanace,
                "type" => $type
            ];
            self::create($data);
            Balance::updateOrCreate(["user_id" => $userId], ["value" => $totalBalanace]);
            return true;
        }

        if ($type === self::DEBIT) {
            $lastBalance  = self::lastBalance($userId);
            if ($lastBalance < $value) {
                return false;
            }
            $totalBalanace = $lastBalance - $value;
            $data = [
                "user_id" => $userId,
                "value" => $value,
                "balance" => $totalBalanace,
                "type" => $type
            ];
            self::create($data);
            Balance::updateOrCreate(["user_id" => $userId], ["value" => $totalBalanace]);
            return true;
        }

        return false;
    }

    static function lastBalance($userId): int
    {
        $balance = 0;
        $result = self::select('balance')->where("user_id", $userId)->latest()->first();
        if ($result) {
            $balance = $result->balance;
        }
        return $balance;
    }

    public function user()
    {
        return $this->belongsTo(User::class, "user_id");
    }
}
