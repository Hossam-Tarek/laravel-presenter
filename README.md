# Laravel Presenter Package

The Laravel Presenter Package is an elegant solution that seamlessly integrates the Presenter design pattern into your 
Laravel applications. This package assists in improving the maintainability and readability of your codebase by separating 
data formatting and manipulation logic from your models and views.


## Content
* [Installation](#installation)
* [Usage](#usage)
* [Creating a new Presenter](#creating-a-new-presenter)
* [Benefits of the Presenter Pattern](#benefits-of-the-presenter-pattern)
* [Contributing](#contributing)
* [License](#license)
* [Credits](#credits)


## Installation

You can easily install the Laravel Presenter Package via Composer by executing the following command:
```bash
composer require hossam-tarek/laravel-presenter
```

If you are using a Laravel version before 5.5, make sure to include the `LaravelPresenterServiceProvider` in your `config/app.php` file.
```php
'providers' => [
    // Other providers
    HossamTarek\LaravelPresenter\LaravelPresenterServiceProvider::class,
],
```


## Creating a new Presenter
- To create a new presenter, you can use the following Artisan command:
    ```bash
    php artisan make:presenter {className}
    ```
    Replace `{className}` with the desired name for your presenter. This command will generate a new presenter class under the `app/Presenters` directory.

- Associating the Presenter by importing the `HasPresenter` trait into your model and set the `$presenterName` variable as follows:
    ```php
    use HossamTarek\LaravelPresenter\Traits\HasPresenter;
    use App\Presenters\OrderPresenter;
    
    class Order extends Model
    {
        use HasPresenter;
    
        protected static $presenterName = OrderPresenter::class;
    }
    ```
   

## Usage

Imagine you want to display the order's status in a visually appealing format based on certain criteria, or even show 
the type of the user that submitted the order:
```php
use HossamTarek\LaravelPresenter\Presenter;

class OrderPresenter extends Presenter
{
    public function formattedStatus()
    {
        if ($this->model->status === 'completed') {
            return '<span class="text-success">Completed</span>';
        } elseif ($this->model->status === 'pending') {
            return '<span class="text-warning">Pending</span>';
        } else {
            return '<span class="text-danger">Unknown</span>';
        }
    }
    
    public function userType()
    {
        return $this->model->guest_id ? 'Guest' : 'User';
    }
}
```
In your view:
```php
<p>{!! $order->formattedStatus() !!}</p>
<span class="text-primary">{{ $order->userType() }}</span>
```
if the method has no parameters you can call it as if it was a property of the model but in snake case:
```php
<p>{!! $order->formatted_status !!}</p>
<span class="text-primary">{{ $order->user_type }}</span>
```


## Benefits of the Presenter Pattern
The Presenter pattern offers several key benefits:

- **Code Separation:** The presenter separates data manipulation logic from your models, preventing your models from becoming cluttered with presentation-related code.
- **Cleaner Views:** By formatting data in presenters, your views remain focused on displaying data rather than implementing logic.
- **Reusability:** Presenters enable you to reuse the same formatting logic across multiple views, ensuring consistent data representation.
- **Maintainability:** Isolating formatting logic in presenters simplifies future changes, making code maintenance smoother.


## Contributing
Your contributions are highly valued as we work together to enhance the Laravel Presenter Package. Feel free to report issues and suggest enhancements to unlock the power of clean code, organization, and improved maintainability.



## License
The Laravel Presenter Package is an open-source software licensed under the [MIT](./LICENSE) license.

## Credits
The Laravel Presenter Package was crafted and is maintained by [Hossam Tarek](https://github.com/Hossam-Tarek).
