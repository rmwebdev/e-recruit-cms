<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(200)->generate('Make me into an QrCode!')) !!} ">



<img src="data:image/png;base64, {!! base64_encode( QrCode::format('png')->merge('https://www.w3adda.com/wp-content/uploads/2019/07/laravel.png', 0.3, true)
                ->size(200)->errorCorrection('H')
                ->generate('W3Adda Laravel Tutorial') )  !!}">


<img src="data:image/png;base64, {!! $asem  !!}">





