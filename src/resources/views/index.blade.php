<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/index.css') }}?v=3" />
</head>
<body>
    <header class="header">
        <div class="header__inner">
            <h1>FashionablyLate</h1>
        </div>
    </header>

<main>
    <div class="contact-form__content">
        <div class="contact-form__heading">
            <h2>Contact</h2>
        </div>
        <form action="/confirm" class="form" method="post">
            @csrf
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お名前</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--name">
                        <input type="text" name="last_name" placeholder="例:山田"
                        value="{{ old('last_name') }}">
                        <input type="text" name="first_name" placeholder="例:太郎"
                        value="{{ old('first_name') }}">
                    </div>
                    <div class="form__error">
                       @error('last_name') {{$message}} @enderror
                       @error('first_name') {{$message}} @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">性別</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--gender">
                        <input type="radio" name="gender" value="male" @checked(old('gender')=='male'>男性
                        <input type="radio" name="gender" value="female" @checked(old('gender')=='female'>女性
                        <input type="radio" name="gender" value="other" @checked(old('gender')=='other'>その他
                    </div>
                    <div class="form__error">
                        @error('gender')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">メールアドレス</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="email" name="email" placeholder="例:test@example.com"
                        value="{{ old('email') }}">
                    </div>
                    <div class="form__error">
                        @error('email')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">電話番号</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--phone">
                        <input type="tel" name="tel1" maxlength="3" placeholder="080"
                        value="{{ old('tel1') }}" >
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel2" maxlength="4" placeholder="1234"
                        value="{{ old('tel2') }}" >
                        <span class="hyphen">-</span>
                        <input type="tel" name="tel3" maxlength="4" placeholder="5678"
                        value="{{ old('tel3') }}">
                    </div>
                    <div class="form__error">
                        @error('tel')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">住所</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="address" placeholder="東京都千駄ヶ谷1-2-3"
                        value="{{ old('address') }}">
                    </div>
                    <div class="form__error">
                        @error('address')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">建物名</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--text">
                        <input type="text" name="building" placeholder="例:千駄ヶ谷マンション101"
                        value="{{ old('building') }}">
                    </div>
                    <div class="form__error">
                        @error('building')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問合わせの種類</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input-select">
                        <select name="category_id" required>
                            <option value="">選択してください</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                 {{ $category->content }}
                                </option>
                                @endforeach
                        </select>
                    </div>
                    <div class="form__error">
                        @error('category_id')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__group">
                <div class="form__group-title">
                    <span class="form__label--item">お問い合わせ内容</span>
                    <span class="form__label--required">※</span>
                </div>
                <div class="form__group-content">
                    <div class="form__input--textarea">
                        <textarea name="content" placeholder="お問い合わせ内容をご記載ください">{{ old('content') }}</textarea>
                    </div>
                    <div class="form__error">
                        @error('content')
                        {{$message}}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form__button">
                <button class="form__button-submit" type="submit">確認画面</button>
            </div>
        </form>
    </div>
</main>
</body>
</html>