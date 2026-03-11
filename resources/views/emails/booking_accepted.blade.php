<h2>Hello {{ $book->name }},</h2>

<p>
Thank you for choosing <strong>ElMo Restaurant</strong>.
We are pleased to inform you that your booking request has been <strong>successfully accepted</strong>.
</p>

<p>
<strong>Booking Details:</strong><br>
Date: {{ $book->date }} <br>
Time: {{ $book->time }} <br>
Guests: {{ $book->NumberOfPerson }}
</p>

<p>
Please make sure to arrive on time. Your reservation will be held for
<strong>15 minutes</strong> after the scheduled time. After that, the reservation may be automatically canceled.
</p>

<p>
If you would like to make a food order in advance or have any special requests,
please contact us at:
</p>

<p>
📞 <strong>01013932470</strong>
</p>

<p>
We look forward to serving you and hope you enjoy a wonderful dining experience at <strong>ElMo Restaurant</strong>.
</p>

<br>

<p>Best Regards,<br>
<strong>ElMo Restaurant Team</strong></p>
