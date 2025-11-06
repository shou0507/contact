<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/confirm.css') }}?v=3" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1>FashionablyLate</h1>
        </div>
    </header>

    <main>
        <div class="confirm__content">
            <div class="confirm__heading">
                <h2>Confirm</h2>
            </div>
            <form action="/thanks" class="form" method="post">
                @csrf
                <div class="confirm-table">
                    <table class="confirm-table--inner">
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お名前</th>
                            <td class="confirm-table__text confirm-table__text--name">
                                <input type="text" name="last_name" value="{{ $contact['last_name'] }}" readonly/>
                                <input type="text" name="first_name" value="{{ $contact['first_name'] }}" readonly/>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">性別</th>
                            <td class="confirm-table__text">
                                <span>
                                    {{ $contact['gender'] === 'male' ? '男性' : ($contact['gender'] === 'female' ? '女性' : 'その他')}}
                                </span>
                                <input type="hidden" name="gender" value="{{ $contact['gender'] }}" readonly>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">メールアドレス</th>
                            <td class="confirm-table__text">
                                <input type="email" name="email" value="{{ $contact['email'] }}" readonly/>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">電話番号</th>
                            <td class="confirm-table__text">
                                <input type="tel" name="tel" value="{{ $contact['tel'] }}" readonly/>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">住所</th>
                            <td class="confirm-table__text">
                                <input type="text" name="address" value="{{ $contact['address'] }}" readonly/>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">建物名</th>
                            <td class="confirm-table__text">
                                <input type="text" name="building" value="{{ $contact['building'] }}" readonly/>
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問合わせの内容の種類</th>
                            <td class="confirm-table__text">
                                <span>{{ $contact['category_content'] }}</span>
                                <input type="hidden" name="category_id" value="{{ $contact['category_id'] }}" readonly />
                            </td>
                        </tr>
                        <tr class="confirm-table__row">
                            <th class="confirm-table__header">お問い合わせ内容</th>
                            <td class="confirm-table__textarea">
                                <input type="text" name="content" value="{{ $contact['content'] }}" readonly />
                            </td>
                        </tr>
                    </table>
                </div>
                    <div class="form__button">
                        <button class="form__button-submit" type="submit">送信</button>
                        <button type="submit" formaction="{{ route('contact.back') }}" formmethod="post" class="form__button-back">修正</button>
                    </div>
            </form>
        </div>
    </main>
</body>
</html>