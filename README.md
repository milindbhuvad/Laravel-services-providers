## Create folder
`app/Services`

## Then create file
`app/Services/PaymentService.php`

## Create Service Provider
`php artisan make:provider PaymentServiceProvider`

## Register Provider
`config/app.php`

'providers' => [
    App\Providers\PaymentServiceProvider::class,
],

## Add Config
`config/services.php`
  
'razorpay' => [  
    'key' => env('RAZORPAY_KEY'),  
    'secret' => env('RAZORPAY_SECRET'),  
],  

`.env`  
RAZORPAY_KEY=your_key  
RAZORPAY_SECRET=your_secret  

## Create Controller
`php artisan make:controller PaymentController`

## Add Routes
`routes/web.php`
    use App\Http\Controllers\PaymentController;  

    Route::get('/payment', [PaymentController::class, 'index']);
    Route::post('/payment/verify', [PaymentController::class, 'verify']);

## Create Blade View
`resources/views/payment.blade.php`

## Run Project
`php artisan serve`

## Open
http://127.0.0.1:8000/payment


## Payu Money Test Card Detail
Mastercard Test Card  
Card Number: 5123 4567 8901 2346  
Expiry: Any future date  
CVV: Any 3 digits  

OTP: 123456  
