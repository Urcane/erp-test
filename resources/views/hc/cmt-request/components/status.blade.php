@switch($status)
    @case($statusEnum[0])
        <i class="fas fa-clock text-warning" style="font-size: 20px;"></i>
    @break

    @case($statusEnum[1])
        <div class="d-inline-flex justify-content-center align-items-center bg-success rounded-circle"
            style="width: 20px; height: 20px;">
            <i class="fas fa-check text-white"></i>
        </div>
    @break

    @case($statusEnum[2])
        <div class="d-inline-flex justify-content-center align-items-center bg-danger rounded-circle"
            style="width: 20px; height: 20px;">
            <i class="fas fa-times text-white"></i>
        </div>
    @break
@endswitch
