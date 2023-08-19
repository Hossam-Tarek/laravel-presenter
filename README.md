# Laravel Presenter Package

The Laravel Presenter Package is an elegant solution that seamlessly integrates the Presenter design pattern into your 
Laravel applications. This package assists in improving the maintainability and readability of your codebase by separating 
data formatting and manipulation logic from your models and views.


## Content
* [Benefits of the Presenter Pattern](#benefits-of-the-presenter-pattern)
* [Installation](#installation)
* [Creating a new Presenter](#creating-a-new-presenter)
* [Usage](#usage)
* [Contributing](#contributing)
* [License](#license)
* [Credits](#credits)


## Benefits of the Presenter Pattern
The Presenter pattern offers several key benefits:

- **Code Separation:** The presenter separates data manipulation logic from your models, preventing your models from becoming cluttered with presentation-related code.
- **Cleaner Views:** By formatting data in presenters, your views remain focused on displaying data rather than implementing logic.
- **Reusability:** Presenters enable you to reuse the same formatting logic across multiple views, ensuring consistent data representation.
- **Maintainability:** Isolating formatting logic in presenters simplifies future changes, making code maintenance smoother.


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
    
    class User extends Model
    {
        use HasPresenter;
    
        protected static $presenterName = UserPresenter::class;
    }
    ```


## Usage

Instead of duplicating the following logic all over your views and violating the SOLID principles:
```php
@if(empty($user_website_url))
    <p>{{ $user->first_name }} {{ $user->last_name }}</p>
@else
    <p>
        <a target="_blank" href="{{ $user->website_url }}">
            {{ $user->first_name }} {{ $user->last_name }}
        </a>
    </p>
@endif
```

Use the command `php artisan make:presenter UserPresenter` to create a new `UserPresenter` and place the presentation logic in it.

Then attach the `UserPresenter` to the `User` model and use the `HasPresenter` trait.
```php
class User extends Model
{
    use \HossamTarek\LaravelPresenter\Traits\HasPresenter;
    
    protected static $presenterName = UserPresenter::class;
}
```

Now use the `UserPresenter` to separate the presentation logic from views and model.
```php
class UserPresenter extendsPresenter
{
    protected $model;
    
    public function formattedName($class = '')
    {
        if (empty($user->website_url)) {
            return "<p class='{$class}'>{$user->first_name} {$user->last_name}</p>"
        }
        
        return <<<HTML
            <p class="{$class}">
                <a target="_blank" href="{$user->website_url}">{$user->first_name} {$user->last_name}</a>
            </p>
        HTML;
    }
}
```

Now you are ready to unleash the power of the Presenter Pattern.

In your views:
```php
{!! $user->formattedName() !!}
```
If the function has no args use the shorter syntax (snake case) without parentheses as if it was a property of the object.
```php
{!! $user->formatted_name !!}
```

If you want to add classes to the `p` tag for more customization.
```php
{!! $user->formattedName("mx-2 my-3") !!}
```


## Contributing
Your contributions are highly valued as we work together to enhance the Laravel Presenter Package. Feel free to report issues and suggest enhancements to unlock the power of clean code, organization, and improved maintainability.


## License
The Laravel Presenter Package is an open-source software licensed under the [MIT](./LICENSE) license.


## Credits
The Laravel Presenter Package was crafted and is maintained by [Hossam Tarek](https://github.com/Hossam-Tarek).
