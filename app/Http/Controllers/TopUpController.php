<?php

namespace App\Http\Controllers;

use App\Models\Mutation;
use App\Models\Topup;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TopUpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $topups = Topup::with("user")->latest()->paginate("10");
        return view("pages.topup.index", compact("topups"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all()->pluck("id", "name");
        return view("pages.topup.form", compact("users"));
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
            "topup" => "required|numeric"
        ]);

        $data = [
            "user_id" => $request->user_id,
            "value" => $request->topup,
            "status" => "DONE"
        ];

        # init db transaction
        DB::beginTransaction();
        try {
            $mutation = Mutation::createMutation($data["user_id"], $data["value"], Mutation::KREDIT);
            if ($mutation) {
                Topup::create($data);
                DB::commit();
            } else {
                DB::rollBack();
                return back()->with("error", "Top Up Gagal, kesalahan saat mutasi data");
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with("error", "Top Up Gagal, karena: {$th->getMessage()}");
        }

        return redirect()->route("topup.index")->with("success", "Top Up berhasil");
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
