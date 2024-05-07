<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Time;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Pagination\Paginator;

class TimeController extends Controller
{
    public function index()
    {
        $users = User::with('times')->get();
        // $times = Time::with('users')->get();

        // $csvData = $users::all();
        return view('index',compact('users'));
    }


    public function store(Request $request)
    {
    $action = $request->input('action');//form button ravel のname"" と('')の記述を合わせる

        switch ($action) {
        case 'clock_in':
            $user = Auth::user(); // 現在ログインしているユーザーを取得
            $user->times()->create([
                'clock_in' => Carbon::now(), // 現在の時刻を出勤時刻として保存
            ]);
            break;
        case 'clock_out':
            $user = Auth::user();
            $user->times()->create([
                'clock_out' => Carbon::now(),
            ]);
            break;
        // case 'break_in':
        //     // 休憩開始の処理
        //     break;
        // case 'bleak_out':
        //     // 休憩終了の処理
        //     break;
        default:
            // その他の処理
            break;
    }

    // 必要に応じてリダイレクトなどの処理を追加
    return back()->with('message', '送信されました');
    }

    public function search(Request $request)
    {
        // if ($request->has('reset')) {
        //     return redirect('/')->withInput();
        // }

        $users = User::with(['times' => function ($query) {
        $query->select('user_id', 'clock_in', 'clock_out')->latest('clock_in'); // 出勤時間で最新のものを取得
        }])->keywordSearch($request->keyword)->orderByDesc('created_at')->paginate(5);
        // dd($users);

        return view('index',compact('users'));
    }
}
