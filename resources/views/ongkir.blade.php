@foreach($ongkir as $item)
<div class="col-4 mb-4">
    <div class="card shadow">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" onclick="serviceFunction({{ $item['cost'][0]['value'] }})" class="form-check-input" name="courier" value="JNE | {{ $item['service'] }}/{{ $item['cost'][0]['value'] }}">
                        <div class="row">
                            <div class="col-12">
                                JNE | {{ $item['service'] }}
                            </div>
                            <div class="col-12">
                                {{ $item['description'] }}
                            </div>
                            <div class="col-12">
                                {{ "Rp " . number_format( $item['cost'][0]['value'],2,',','.') }}
                            </div>
                            <div class="col-12">
                                Estimasi {{ $item['cost'][0]['etd'] }} hari
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="col-4 mb-4">
    <div class="card shadow">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" onclick="serviceFunction(8000)" class="form-check-input" name="courier" value="POS | OKE}/8000">
                        <div class="row">
                            <div class="col-12">
                                Kantor Pos | Oke
                            </div>
                            <div class="col-12">
                                Layanan Reguler
                            </div>
                            <div class="col-12">
                                {{ "Rp " . number_format( 8000,2,',','.') }}
                            </div>
                            <div class="col-12">
                                Estimasi 3 hari
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-4 mb-4">
    <div class="card shadow">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" onclick="serviceFunction(5000)" class="form-check-input" name="courier" value="POS | REG}/5000">
                        <div class="row">
                            <div class="col-12">
                                Kantor Pos | Reg
                            </div>
                            <div class="col-12">
                                Layanan Reguler
                            </div>
                            <div class="col-12">
                                {{ "Rp " . number_format( 5000,2,',','.') }}
                            </div>
                            <div class="col-12">
                                Estimasi 3 hari
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-4 mb-4">
    <div class="card shadow">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" onclick="serviceFunction({{ $item['cost'][0]['value'] }})" class="form-check-input" name="courier" value="J&T | {{ $item['service'] }}/{{ $item['cost'][0]['value'] }}">
                        <div class="row">
                            <div class="col-12">
                                J&T | {{ $item['service'] }}
                            </div>
                            <div class="col-12">
                                {{ $item['description'] }}
                            </div>
                            <div class="col-12">
                                {{ "Rp " . number_format( $item['cost'][0]['value'],2,',','.') }}
                            </div>
                            <div class="col-12">
                                Estimasi {{ $item['cost'][0]['etd'] }} hari
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-4 mb-4">
    <div class="card shadow">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <div class="form-group">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" onclick="serviceFunction(15000)" class="form-check-input" name="courier" value="TIKI | REG}/15000">
                        <div class="row">
                            <div class="col-12">
                                Tiki | Reg
                            </div>
                            <div class="col-12">
                                Layanan Reguler
                            </div>
                            <div class="col-12">
                                {{ "Rp " . number_format( 15000,2,',','.') }}
                            </div>
                            <div class="col-12">
                                Estimasi 3 hari
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
    </div>
</div>