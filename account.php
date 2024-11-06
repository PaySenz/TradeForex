<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login"); // Redirect to login page if not logged in
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account | Quotex demo account</title>
    <link rel="stylesheet" href="assets/css/style1.css">
    <link rel="stylesheet" href="assets/css/style2.css">
    <link rel="stylesheet" href="assets/css/style8.css">
</head>
<body>
    <div class="page__content">
        <div class="content-section__block">
            <div class="page__content-header" dir="auto">
                <div class="page__content-nav tabs-menu tabs-menu--collapse-md">
                    <div class="tabs-menu__current">Account</div>
                    <nav class="tabs-menu__bar">
                        <a href="https://qxbroker.com/en/deposit" class="tabs-menu__tab">Deposit</a>
                        <a href="https://qxbroker.com/en/withdrawal" class="tabs-menu__tab">Withdrawal</a>
                        <a class="tabs-menu__tab" href="/en/balance">Transactions</a>
                        <a class="tabs-menu__tab" href="/en/trades">Trades</a>
                        <a aria-current="page" class="tabs-menu__tab active" href="/en/settings">Account</a>
                        <a class="tabs-menu__tab" href="/en/market">Market</a>
                        <a class="tabs-menu__tab" href="/en/tournaments">Tournaments</a>
                        <a class="tabs-menu__tab" href="/en/analytics">Analytics</a>
                    </nav>
                </div>

                <div class="balance balance__margin">
                    <div class="balance__label">My current currency</div>
                    <div class="balance__currency">
                        <span class="balance__currency-icon">$</span><b>USD</b>
                        <div class="balance__button">Change</div>
                    </div>
                </div>

                <div class="balance">
                    <div class="balance__label">Available for withdrawal</div>
                    <div class="balance__value">0.00$</div>
                </div>

                <div class="balance">
                    <div class="balance__label">In the account</div>
                    <div class="balance__value">0.00$</div>
                </div>
            </div>

            <div class="profile-page page__sections" dir="ltr">
                <div class="page__sections-row">
                    <div class="page__sections-column grow-2of4">
                        <div class="page__sections-row" dir="auto">
                            <form class="content-section grow-1of2 shrink profile__form form">
                                <div class="content-section__head">Personal data:</div>
                                <div class="form__control">
                                    <div class="form-avatar">
                                        <div class="form-avatar__image-block">
                                            <div class="form-avatar__avatar-profile">
                                                <!-- Placeholder for Profile SVG Icon -->
                                            </div>
                                        </div>
                                        <div class="form-avatar__photo">
                                            <input class="upload-control__input" type="file" name="file" accept=".jpg, .jpeg, .png">
                                        </div>
                                        <div class="form-avatar__block">
                                            <div class="form-avatar__block-email">faizshiraji@gmail.com</div>
                                            <div class="form-avatar__block-text">ID: 50463459</div>
                                            <div class="form-avatar__block-label warning">
                                                Not verified
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="content-section__onboarding">
                                    <div class="form__control">
                                        <label class="input-control-cabinet input-control-cabinet--text">
                                            <span class="input-control-cabinet__label">Nickname</span>
                                            <input name="nickname" class="input-control-cabinet__input" placeholder="#50463459" value="#50463459">
                                        </label>
                                    </div>

                                    <div class="form__control">
                                        <label class="input-control-cabinet input-control-cabinet--text">
                                            <span class="input-control-cabinet__label">First Name</span>
                                            <input name="first_name" class="input-control-cabinet__input" placeholder="Empty" value="">
                                        </label>
                                    </div>

                                    <div class="form__control">
                                        <label class="input-control-cabinet input-control-cabinet--text">
                                            <span class="input-control-cabinet__label">Last Name</span>
                                            <input name="last_name" class="input-control-cabinet__input" placeholder="Empty" value="">
                                        </label>
                                    </div>

                                    <div class="form__control">
                                        <label class="input-control-cabinet input-control-cabinet--text">
                                            <span class="input-control-cabinet__label">Date of birth</span>
                                            <input name="birthday" type="date" class="input-control-cabinet__input" placeholder="Empty" value="">
                                        </label>
                                    </div>

                                    <div class="form__control">
                                        <label class="input-control-cabinet input-control-cabinet--text input-control-cabinet__border disabled">
                                            <span class="input-control-cabinet__label disabled">Email</span>
                                            <input class="input-control-cabinet__input" disabled type="email" placeholder="Empty" value="faizshiraji@gmail.com">
                                        </label>
                                    </div>

                                    <div class="form__control">
                                        <label class="input-control-cabinet input-control-cabinet--text">
                                            <span class="input-control-cabinet__label">Address</span>
                                            <input name="address" class="input-control-cabinet__input" placeholder="Empty" value="">
                                        </label>
                                    </div>
                                    <button type="submit" class="form__submit button button--primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>