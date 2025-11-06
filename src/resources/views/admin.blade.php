<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}?v=7" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1>FashionablyLate
            <form class="form" action="/logout" method="post">
                @csrf
                <button type="submit" class="ghost-btn">logout</button>
            </form>
            </h1>
        </div>
    </header>
    
    <main>
        <div class="search-form__content">
            <div class="search-form__heading">
                <h2>Admin</h2>
            </div>
        </div>
        <form action="/admin" class="form" method="get">
            <div class="search-form__group">
                <input type="text" name="keyword" class="search-form__input" placeholder="名前やメールアドレスを入力してください" value="{{request('keyword')}}">
            </div>
            <div class="search-form__group">
                <select name="gender" class="search-form__gender">
                    <option value="">性別</option>
                    <option value="male"   {{ request('gender')==='male'?'selected':'' }}>男性</option>
                    <option value="female" {{ request('gender')==='female'?'selected':'' }}>女性</option>
                    <option value="other"  {{ request('gender')==='other'?'selected':'' }}>その他</option>
                </select>
            </div>
            <div class="search-form__group">
                <select name="category" class="search-form__contact">
                    <option value="">お問合せ内容の種類</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ (string)$cat->id === (string)request('category') ? 'selected' : '' }}>
                        {{ $cat->content }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="search-form__group">
                <input type="date" name="date" class="search-form__date">
            </div>
            <div class="search-form__group">
                <button class="search-form__button search-form__button--search" type="submit">検索</button>
                <a href="/admin" class="search-form__button search-form__button--reset">リセット</a>
            </div>
        </form>

        <div class="square-pagination">
            {{$contacts->links()}}
        </div>
        <section class="admin-table__wrap">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>お名前</th>
                        <th>性別</th>
                        <th>メールアドレス</th>
                        <th>お問合せの種類</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($contacts as $contact)
                    <tr>
                        <td>{{$contact->last_name}} {{$contact->first_name}}</td>
                        <td>{{$contact->gender_label}}</td>
                        <td>{{$contact->email}}</td>
                        <td>{{ optional($contact->category)->content }}</td>
                        <td>
                            <a href="{{route('admin.index', ['detail' => $contact->id])}}" class="detail-btn">詳細</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </section>

        @if($selected)
        <div class="modal-backdrop">
            <div class="modal">
                <div class="modal-box">
                    <a href="{{route('admin.index')}}" class="modal-close" aria-label="閉じる">X</a>
                    <table class="confirm-table__inner">
                        <tr class="confirm-table__row">
                            <th>お名前</th>
                            <td>
                                <div class="confirm-table__text--name">
                                    <input type="text" value="{{$selected->last_name}}" readonly>
                                    <input type="text" value="{{$selected->first_name}}" readonly>
                                </div>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th>性別</th>
                            <td>
                                {{$selected->gender === 'male' ? '男性' : ($selected->gender === 'female' ? '女性' : 'その他')}}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th>メールアドレス</th>
                            <td><input type="email" value="{{$selected->email}}" readonly></td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th>電話番号</th>
                            <td><input type="tel" value="{{$selected->tel}}" readonly></td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th>住所</th>
                            <td><input type="text" value="{{$selected->address}}" readonly></td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th>建物名</th>
                            <td><input type="text" value="{{$selected->building}}" readonly></td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th>お問合せ内容の種類</th>
                            <td>
                                {{optional($selected->category)->content}}
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th>お問合せ内容</th>
                            <td><input type="text" value="{{$selected->content}}" readonly></td>
                        </tr>
                    </table>
                    <form action="{{route('contacts.destroy', ['contact' => $selected])}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    </main>
</body>
</html>