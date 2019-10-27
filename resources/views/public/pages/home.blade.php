@extends('layouts.publicMaster')

@section('title', 'Home')

@section('content')

<section id="banner">
    <div class="image filtered" data-position="center"><img src="img/pic01.jpg" alt=""></div>
    <div class="content">
        <h1>Sed amet lorem</h1>
        <p>Magna amet tempus etiam lorem nisl consequat</p>
        <ul class="actions special">
            <li><a href="#first" class="button wide scrolly">Get Started</a></li>
        </ul>
    </div>
</section>
<section id="first" class="main special">
    <h2>Nisl feugiat adipiscing</h2>
    <p>Lorem ipsum dolor sit amet nullam consequat, feugiat nisl tempus
        <br> adipiscing sed cursus. Ipsum tempus phasellus magna.</p>
    <ul class="features">
        <li><span class="icon major fa-gem"></span>
            <h3>Aliquam</h3></li>
        <li><span class="icon major fa-comment-dots"></span>
            <h3>Feugiat</h3></li>
        <li><span class="icon major fa-save"></span>
            <h3>Consequat</h3></li>
        <li><span class="icon major fa-flag"></span>
            <h3>Phasellus</h3></li>
    </ul>
</section>
<section class="main spotlight left invert accent1">
    <div class="image filtered" data-position="center"><img src="img/pic02.jpg" alt=""></div>
    <div class="content">
        <h2>Magna amet lorem</h2>
        <p>Sed magna lorem ipsum etiam dolor et nullam consequat, et feugiat tempus consequat.</p>
        <ul class="actions">
            <li><a href="#one" class="button">More</a></li>
        </ul>
    </div>
</section>
<section class="main special">
    <h2>Etiam amet consequat</h2>
    <p>Lorem ipsum dolor sit amet nullam consequat, feugiat nisl tempus
        <br> adipiscing sed cursus. Ipsum tempus phasellus magna.</p>
    <div class="slider-wrapper">
        <div class="slider">
            <article class="inactive">
                <a href="#" class="image filtered"><img src="img/slide03.jpg" alt=""></a>
                <div class="content">
                    <p>Aliquam feugiat magna consequat</p>
                </div>
            </article>
            <article class="inactive">
                <a href="#" class="image filtered"><img src="img/slide01.jpg" alt=""></a>
                <div class="content">
                    <p>Dolor phaselllus et cursus nullam</p>
                </div>
            </article>
            <article class="initial">
                <a href="#" class="image filtered"><img src="img/slide02.jpg" alt=""></a>
                <div class="content">
                    <p>Ipsum dolor sit amet nullam feugiat</p>
                </div>
            </article>
            <article class="inactive">
                <a href="#" class="image filtered"><img src="img/slide03.jpg" alt=""></a>
                <div class="content">
                    <p>Nisl lorem phasellus aliquam magna</p>
                </div>
            </article>
            <article class="inactive">
                <a href="#" class="image filtered"><img src="img/slide01.jpg" alt=""></a>
                <div class="content">
                    <p>Adipiscing lorem nulla etiam dolor</p>
                </div>
            </article>
        </div>
    </div>
</section>
<section class="main special invert accent3">
    <h2>Nullam dolor veroeros</h2>
    <p>Sit amet nullam consequat, feugiat nisl tempus adipiscing sed consequat cursus.</p>
    <form method="post" action="#" class="combined">
        <input type="email" name="email" value="" placeholder="Your email address">
        <button type="submit" class="primary">Sign Up</button>
    </form>
</section>
<section class="main special">
    <h2>Get in touch</h2>
    <p>Lorem ipsum dolor sit amet nullam consequat, feugiat nisl tempus.</p>
    <ul class="contact-icons">
        <li><span class="icon major alt fa-envelope"></span>
            <p><a href="#">information@untitled.tld</a></p>
        </li>
        <li><span class="icon major alt fa-map"></span>
            <p>1234 Somewhere Road
                <br> Nashville, TN 00000</p>
        </li>
        <li><span class="icon solid major alt fa-mobile-alt"></span>
            <p><a href="#">(000) 000-0000</a></p>
        </li>
    </ul>
</section>

    
@endsection




