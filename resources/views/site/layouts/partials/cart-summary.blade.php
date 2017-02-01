<table class="table">
    <thead>
        <tr>
            <th>المنتجات</th>
            <th>الكميه</th>
            <th>التكلفة</th>
        </tr>
    </thead>
    @foreach ($basket->all() as $item)
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->quantity }}</td>
            <td>{{ number_format($item->quantity * $item->getDiscount()) }} ريال</td>
        </tr>
    @endforeach
</table>
<table class="table">
    <thead>
        <tr>
            <th>ملخص التكاليف</th>
        </tr>
    </thead>
    <tr>
        <td>تكاليف المشتريات</td>
        <td>{{ number_format($basket->subTotal()) }} ريال</td>
    </tr>
    <tr>
        <td>تكاليف الشحن</td>
        <td>5,00 ريال</td>
    </tr>
    <tr>
        <td class="success">إجمالي المشتريات</td>
        <td class="success">{{ number_format(($basket->subTotal() + 5)) }} ريال</td>
    </tr>
</table>
