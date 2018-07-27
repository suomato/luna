# LUNA CLI
> Command-line interface for Base Camp theme.

## Commands

* [Make Custom Post Type](#make-custom-post-type)
* [Make Custom Taxonomy](#make-custom-taxonomy)
* [Make Route](#make-route)
* [Make Shortcode](#make-shortcode)
* [Make Menu Page](#make-menu-page)

#### Make Custom Post Type

> This Command helps you to create a new Custom Post Type very fast.

```
php luna make:custom-post-type {name}
```

> The argument is singular form. if noun have irregular plural which do not behave in standard way(singular+s),
exception can be defined by plural option e.g.

```
php luna make:custom-post-type person --plural=people
```

> The new file is created to `/app/config/wp/custom-post-types/{name}.php`

#### Make Custom Taxonomy

> This Command helps you to create a new Custom Taxonomy very fast.

```
php luna make:custom-taxonomy {name}
```

> The argument is singular form. if noun have irregular plural which do not behave in standard way(singular+s),
exception can be defined by plural option e.g.

```
php luna make:custom-taxonomy country --plural=countries
```

> The new file is created to `/app/config/wp/custom-taxonomies/{name}.php`

#### Make Route

> This Command helps you to create a new route for WordPress API clearer and faster way.

```
php luna make:route {name}
```

> The new file is created to `/app/config/wp/routes/{name}.php`. The created file comes with the well documented boilerplate.

#### Make Shortcode

> This Command helps you to create a new shortcode with very clean boilerplate.

```
php luna make:shortcode {name}
```

> The new file is created to `/app/config/wp/shortcodes/{name}.php`.

##### Example

Run command:

```
php luna make:shortcode LuckyNumber
```

Then define some data
```
    /**
     * @var string Shortcode name
     */
    protected $shortcode = 'lucky_number';

    /**
     * @var array|string An associative array of attributes
     */
    protected $attributes = [
        'number' => 7,
    ];

    /**
     * Return template of shortcode
     *
     * @param $attr An associative array of attributes
     * @param $content Enclosed content
     *
     * @return mixed
     */
    protected function template($attr, $content)
    {
        return 'This is my lucky number: ' . $attr['number'];
    }
```

> Now shortcode `[lucky_number]` generates `This is my lucky number: 7` and `[lucky_number number="13"]` generates `This is my lucky number: 13`

> It is also possible to use power of Timber. In template function you can return Timber view instead of string like this:

```
// resources/views/shortcodes/lucky-number.twig

<p>This is my lucky number: {{ number }}</p>

******************************************************************

// app/config/wp/shortcodes/LuckyNumber.php

protected function template($attr, $content)
{
    return \Timber::compile('shortcodes/lucky-number.twig', $attr);
}
```

#### Make Menu Page

> This Command helps you to create a new Menu Page or Submenu Page to wp-admin navigation.

```
php luna make:menu-page {name}
```

> This command will create a new MenuPage class in `/app/config/wp/menu-pages/{name}.php`. The generated file will include the Menu Page properties. Submenu Page could be created by:

```
php luna make:menu-page {name} --submenu
```

> A new SubMenuPage class will be generated in `/app/config/wp/submenu-pages/{name}.php`

