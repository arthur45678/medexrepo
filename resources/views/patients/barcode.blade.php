{{-- @dump($patient) --}}
<style>
    .barcode-container{
        display: inline-block;
        width: 150px;
        text-align: center;
    }
    .barcode-text{
        text-align: center;
        margin: 2px;
        font-size: 12px;
    }
    .barcode-codepart {
        margin: 7px 0;
    }
</style>
{{--

 'c39', 1.1, 44
'C128', 1.9, 44
--}}
<div class="barcode-container">
    <p class="barcode-text">{{$patient->all_names}}</p>
    {{-- <p class="barcode-text">{{$patient->soc_card}}</p> --}}
    <p class="barcode-codepart">
        {{-- {!! '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG("$patient->soc_card", 'C128', 1.5, 44, array(1,1,1), true) . '" alt="'.$patient->soc_card.'"   class="img img-fluid"/>' !!} --}}
        {!! DNS1D::getBarcodeSVG("$patient->soc_card", 'C128', 1.2, 44) !!}
    </p>

</div>
