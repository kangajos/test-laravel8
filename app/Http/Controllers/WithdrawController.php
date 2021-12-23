<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Mutation;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdraws = Withdraw::with("user")->latest()->paginate(10);
        return view("pages.withdraw.index", compact("withdraws"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $balances = Balance::with("user")->get();
        return view("pages.withdraw.form", compact("balances"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "user_id" => "required",
            "withdraw" => "required|numeric"
        ]);

        $data = [
            "user_id" => $request->user_id,
            "value" => $request->withdraw,
            "status" => "DONE"
        ];

        # init db transaction
        DB::beginTransaction();
        try {
            $mutation = Mutation::createMutation($data["user_id"], $data["value"], Mutation::DEBIT);
            if ($mutation) {
                Withdraw::create($data);
                DB::commit();
            } else {
                DB::rollBack();
                return back()->with("error", "Withdraw Gagal, kesalahan saat mutasi data");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with("error", "Withdraw Gagal, karena: {$th->getMessage()}");
        }

        return redirect()->route("withdraw.index")->with("success", "Withdraw berhasil");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
