@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
@endsection

@section('content')
    <div class="attendance__alert">
        @if (session('message'))
        <div class="attendance__alert--success">
            {{ session('message')}}
        </div>
        @endif
    </div>

    <div class="attendance__content">
        <div class="attendance__panel">
            {{-- <form class="attendance__button" action="index" method="post">
            <input class="attendance__button-submit" type="submit">勤務開始</input>
            </form>
            <form class="attendance__button">
            <button class="attendance__button-submit" type="submit">勤務終了</button>
            </form> --}}
            <form action="/save" method="post">
                @csrf
                <button type="submit" name="action" value="clock_in">出勤</button>
            </form>

            <form action="/save" method="post">
                @csrf
                <button type="submit" name="action" value="clock_out">退勤</button>
            </form>
        </div>
        {{-- カレンダー表示 日付画面 --}}
        <input class="search-form__date" type="date" name="date" value="{{ request('date') }}">

        <div class="export-form">
                <form action="{{ '/export?' . http_build_query(request()->query()) }}" method="post">
                    @csrf
                    <input class="export__btn btn" type="submit" value="エクスポート">
                </form>
        </div>

        <form class="search-form" action="/search" method="get">
            @csrf
            <input class="search-form__keyword-input" type="text" name="keyword" placeholder="お名前を入力してください"               value="{{ old ('keyword') }}">

            <input class="search-form__search-btn btn" type="submit" value="検索">
            {{-- <input class="search-form__reset-btn btn" type="submit" value="リセット" name="reset"> --}}
        </form>

        <table class="search__table">
            <tr class="search__row">
                <th class="search__label">お名前</th>
                <th class="search__label">出勤時間</th>
                <th class="search__label">退勤時間</th>
                {{-- ページネーション表示 --}}
                {{-- {{ $users->links('vendor.pagination.simple-tailwind') }} --}}
            </tr>
            @foreach ($users as $user)
                <tr>
                    <td class="search__data">{{ $user->name }}</td>
                    @if ($user->times->isNotEmpty())
                            <td class="search__data">{{ $user->times->first()->clock_in }}</td>
                            <td class="search__data">{{ $user->times->last()->clock_out }}</td>
                    @else
                            <td class="search__data">-</td>
                            <td class="search__data">-</td>
                    @endif
                            <td class="search__data">
                            <a class="search__detail-btn" href="#{{ $user->id }}">詳細</a>
                            </td>
                </tr>

                {{-- <div class="modal" id="{{ $user->id }}">
                    <a href="#!" class="modal-overlay"></a>
                    <div class="modal__inner">
                        <div class="modal__content">
                            <form class="modal__detail-form" action="/delete" method="post">
                                @csrf
                                <div class="modal-form__group">
                                    <label class="modal-form__label" for="">お名前</label>
                                    <p>{{ $user->name }}</p>
                                </div>
                                <div class="modal-form__group">
                                    <label class="modal-form__label" for="">メールアドレス</label>
                                    <p>{{ $user->email }}</p>
                                </div>
                                <input type="hidden" name="id" value="{{ $user->id }}">
                                    <input class="modal-form__delete-btn btn" type="submit" value="削除">
                            </form>
                        </div>
                        <a href="#" class="modal__close-btn">×</a>
                    </div>
                </div> --}}
            @endforeach
        </table>
    </div>
@endsection
