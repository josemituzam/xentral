<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
@php
    if($plantilla->size == 'A4'){
        $size = 'A4';
    } else {
        $size = $plantilla->page_width.'mm '.$plantilla->page_height.'mm !important';
    }
    $margin = $plantilla->margin_top.'px '.$plantilla->margin_right.'px '.$plantilla->margin_bottom.'px '.$plantilla->margin_left.'px !important';
@endphp
<!--  margin: 27mm 16mm 27mm 16mm; -->
<style>
    @page {
        font-family: sans-serif;
        letter-spacing: 0.05em;
        font-size: 12px;
        size: {{$size}}; 
        margin: {{$margin}};
    }

    table{
        font-size: 10px;
        width: 100%;
    }

    .table-border{
        border: 1px solid gray;
        border-collapse: collapse;
    }
    
    .table-border td, .table-border th {
        border: 1px solid gray;
        padding-left: 2px;
    }
</style>