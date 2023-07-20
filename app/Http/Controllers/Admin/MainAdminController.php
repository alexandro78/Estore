<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Size;
use App\Models\Image as ImageModel;
use Image;


class MainAdminController extends Controller
{
    /*
| methods must be named in camel case way
| exm: public function adminProfile()
| */

    public function ifregistered()
    {
        return view('layouts.admin-dashboard.product-table');
    }
    public function getAdminProfile()
    {
        return view('layouts.admin-dashboard.admin-profile');
    }

    public function getHome()
    {
        return view('layouts.admin-dashboard.layout');
    }



    function generateClosure($name) {
        return function () use ($name) {
            // Использование переменной $name из внешнего контекста
            return "Hello, $name!";
        };
    }
    

    public function getCustomers()
    {
        return view('layouts.admin-dashboard.customers-page');
    }

    public function getOrders()
    {
        return view('layouts.admin-dashboard.orders-page');
    }

    public function getMessage()
    {
        return view('layouts.admin-dashboard.message');
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////


    //вытягивает связанные поля из таблиц дисконт, категории, размер
    //чтобы сформировать форму для создания нового товара на странице Додати товар
    public function addNewProductPage()
    {
        // $status = Product::all();
        $discounts = Discount::all();
        $categories = Category::all();
        $sizes = Size::all();
        return view('layouts.admin-dashboard.add-new-product-page', [
            'sizes' => $sizes,
            // 'status' => $status,
            'categories' => $categories,
            'discounts' => $discounts
        ]);
    }

    //отправляем обновленный товар в базу по id/////////////////////////////////////////////////////////
    public function sendEditProduct(Request $request, $id) //////////////////////////////////////////////
    { ///////////////////////////////////////////////////////////////////////////////////////////////////
        //////////////////////////////////////////////////2222222222222222222222222222222222222222222222
        $category = Category::where('name', '=', $request->input('category'))->first();
        $size = Size::where('size', '=', $request->input('item_size'))->first();
        $discount = Discount::where('name', '=', $request->input('sale_discount'))->first();

        $categoryId = $category == null ? null : $category->id;
        $sizeId = $size == null ? null : $size->id;
        $discountId = $discount == null ? null : $discount->id;

        $data = [
            'name' => $request->input('item_name'),
            'description' => $request->input('description'),
            'color' => $request->input('color'),
            'in_stock' => $request->input('item_status'),
            'price' => $request->input('price'),
            'brand' => $request->input('brand'),
            'country' => $request->input('country'),
            'date_add' => $request->input('date_add'),
            'date_update' => $request->input('date_update'),
            'quantity' => $request->input('quantity'),
            'category_id' => $categoryId,
            'size_id' => $sizeId,
            'discount_id' => $discountId,
        ];


        //логика добавления изображений к товару
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                // Создание экземпляра Intervention Image для каждого изображения
                $img = Image::make($image);
                $img->orientate();
                
                $newImage = new ImageModel();
                $filename = $image->getClientOriginalName();
                $newImage->filename = $filename;
                $newImage->product_id = $id;
                $newImage->save();
                // Обработка каждого файла

                $img->save(public_path('images/multimedia/' . $filename));
                // Дополнительные действия, такие как сохранение информации в базу данных


                // Очистка экземпляра Intervention Image после обработки каждого изображения
            }
            $img->destroy();
        }

        Product::where('id', $id)->update($data);
        return redirect()->route('product');
    }

    //переводит на редактировние товара по id и заполняет поля из старыми значениями с базы
    public function showEditProductById($id)
    {
        $productFields = Product::find($id);

        $thumbnails = [];
        foreach ($productFields->images as $image) {
            $thumbnailPath = 'images/thumbnails/' . $image->filename; // Путь для сохранения миниатюры
            $thumbnailExists = file_exists(public_path($thumbnailPath)); // Проверка наличия миниатюры
            if ($thumbnailExists) {
                $thumbnails[$image->id] = $thumbnailPath;
            } else {
                $thumbnail = Image::make(public_path('images/multimedia/' . $image->filename))->fit(100, 100);
                $thumbnail->save(public_path($thumbnailPath));
                $thumbnails[$image->id] = $thumbnailPath;
            }
        }

        return view('layouts.admin-dashboard.edit-product', [
            'id' => $id,
            'productFields' => $productFields,
            'categories' => Category::all(),
            'discounts' => Discount::all(),
            'sizes' => Size::all(),
            'thumbnails' => $thumbnails
        ]);
    }

    public function imageDeleteById($id, $productId)
    {
        $image = ImageModel::find($id);

        $thumbnailPath = 'thumbnails/' . $image->filename;
        if (file_exists(public_path($thumbnailPath))) {
            unlink(public_path($thumbnailPath));
        }

        $imagePath = 'multimedia/' . $image->filename;
        if (file_exists(public_path($imagePath))) {
            unlink(public_path($imagePath));
        }

        $image->delete();
        return redirect()->route('edit.product.page', ['id' => $productId]);

    }

    //получает в таблицу все продукты из базы
    public function getProduct()
    {
        $products = Product::all();
        $data = $products->map(function ($products) {
            $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" onclick="location.href = \'' . route('edit.product.page', ['id' => $products->id]) . '\'">
        <i class="fa fa-lg fa-fw fa-pen"></i>
        </button>';
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="location.href = \'' . route('product.delete', ['id' => $products->id]) . '\'">
          <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';

            return [
                '<nobr>' . $btnDelete . $btnEdit . '</nobr>',
                $products->id,
                $products->name,
                $products->description,
                $products->price,
                $productCategoryName  =  $products->category->name ?? 'Без категорії',
                $productSizeName = $products->size->size ?? 'Не вказано',
                $products->color,
                $products->quantity,
                $products->brand,
                $products->article,
                $productDiscount = $products->discount->name ?? 'Без знижки',
                $products->in_stock == 1 ? '<i class="bi bi-check-lg text-success">В наявності</i>' : 'Товар відсутній',
            ];
        });

        return view('layouts.admin-dashboard.product-table', ['data' => $data]);
    }

    //после того как метод addNewProduct извлек статусы, скидки, категории, и размеры этот
    //добавляет новый продукт с нуля на странице добавить новый товар
    public function addProduct(Request $request)
    { ////////////////////////////////////////////////////111111111111111111111111111111111111111
        // get the id field from the name field
        $categoryId = Category::where('name', '=', $request->input('category'),)->firstOrFail()->id;
        $sizeId = Size::where('size', '=', $request->input('item_size'))->firstOrFail()->id;
        $discount = Discount::where('name', '=', $request->input('sale_discount'))->first();
        if ($discount == null) {
            $discountId = null;
        } else {
            $discountId = $discount->id;
        }

        function generateArticleNumber()
        {
            $articleNumber = mt_rand(10000000, 99999999);
            return $articleNumber;
        }
        $articleNumber = generateArticleNumber(); // Генерация первого артикула

        while (Product::where('article', $articleNumber)->exists()) {
            // Если артикул уже существует, генерируем новый артикул
            $articleNumber = generateArticleNumber();
        }

        $data = [
            'name' => $request->input('item_name'),
            'article' =>  $articleNumber,
            'description' => $request->input('description'),
            'color' => $request->input('color'),
            'in_stock' => $request->input('item_status'),
            'price' => $request->input('price'),
            'brand' => $request->input('brand'),
            'country' => $request->input('country'),
            'date_add' => $request->input('date_add'),
            'date_update' => $request->input('date_update'),
            'quantity' => $request->input('quantity'),
            'category_id' => $categoryId,
            'size_id' => $sizeId,
            'discount_id' => $discountId,
            'color_code' => $request->input('color_code')
        ];
        $product = new Product($data);
        $product->save();
        //логика добавления изображений к товару
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                // Создание экземпляра Intervention Image для каждого изображения
                $img = Image::make($image);
                $img->orientate();

                $newImage = new ImageModel();
                $filename = $image->getClientOriginalName();
                $newImage->filename = $filename;
                $newImage->product_id = $product->id;
                $newImage->save();
                // Обработка каждого файла

                $img->save(public_path('images/multimedia/' . $filename));
                // Дополнительные действия, такие как сохранение информации в базу данных


                // Очистка экземпляра Intervention Image после обработки каждого изображения
            }
            $img->destroy();
        }
        return redirect()->route('add.product.page');
    }


    //удаляет продукт по id
    public function productDelete($id)
    {
        Product::destroy($id);
        return redirect()->route('product');
    }

    ////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////
    public function getDiscountTable()
    {
        $discounts = Discount::all();
        $data = $discounts->map(function ($discounts) {
            $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit" onclick="location.href = \'' . route('edit.discount.page', ['id' => $discounts->id]) . '\'">
        <i class="fa fa-lg fa-fw fa-pen"></i>
        </button>';
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="location.href = \'' . route('delete.discount', ['id' => $discounts->id]) . '\'">
        <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';
            $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
        <i class="fa fa-lg fa-fw fa-eye"></i>
        </button>';

            return [
                '<nobr>' . $btnDelete . $btnEdit . '</nobr>',
                $discounts->id,
                $discounts->name,
                $btnDetails,
                $discounts->price_off,
                $discounts->min_amount,
                $discounts->start_date,
                $discounts->end_date,
            ];
        });
        return view('layouts.admin-dashboard.discount-table', ['data' => $data]);
    }

    public function addNewDiscount(Request $request)
    {
        $data = [
            'name' => $request->input('disc-name'),
            'start_date' => $request->input('start-discount'),
            'end_date' => $request->input('stop-discount'),
            'description' => $request->input('description'),
            'price_off' => $request->input('disc-sum'),
            'min_amount' => $request->input('min-sum'),
        ];

        $discount = new Discount($data);
        $discount->save();
        return redirect()->route('add.discount.page');
    }

    public function addNewDiscountPage()
    {
        return view('layouts.admin-dashboard.add-new-discount');
    }

    public function discountDelete($id)
    {
        Discount::destroy($id);
        return redirect()->route('discount');
    }

    public function editDiscountPage($id)
    {
        $discountFields = Discount::find($id);

        return view('layouts.admin-dashboard.edit-discount-page', [
            'id' => $id,
            'name' => $discountFields->name,
            'start_date' => $discountFields->start_date,
            'end_date' => $discountFields->end_date,
            'description' => $discountFields->description,
            'price_off' => $discountFields->price_off,
            'min_amount' => $discountFields->min_amount,
        ]);
    }


    public function updateDiscount(Request $request, $id)
    {
        $data = [
            'name' => $request->input('disc-name'),
            'start_date' => $request->input('start-discount'),
            'end_date' => $request->input('stop-discount'),
            'description' => $request->input('description'),
            'price_off' => $request->input('disc-sum'),
            'min_amount' => $request->input('min-sum'),
        ];
        Discount::where('id', $id)->update($data);
        return redirect()->route('discount');
    }

    ////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////    
    public function getCategory()
    {
        $categorie = Category::all();
        $data = $categorie->map(function ($categorie) {
            $btnEdit = '<button onclick="editCategory(this)" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-pen"></i>
        </button>';
            $btnDelete = '<button onclick="deleteCategory(this)" class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
          <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';

            return [
                $categorie->id,
                $categorie->name,
                '<nobr>' . $btnEdit . $btnDelete . '</nobr>',
            ];
        });
        return view('layouts.admin-dashboard.category-table', ['data' => $data]);
    }

    public function deleteCategoryById(Request $request)
    {
        $data = $request->json()->all();
        Category::destroy($data['id']);
        return response()->json(['id' => $data['id']]);
    }

    public function addCat(Request $request)
    {
        // Обработка данных из формы
        $data = $request->json()->all();
        $category = new Category();
        $category->name = $data['name'];
        $category->save();
        return redirect()->route('category');
    }

    public function editCategoryByAjax(Request $request)
    {
        // Get the JSON data from the request
        $data = $request->json()->all();
        $category = new Category();
        $category = Category::find($data['id']);
        $category->name = $data['name'];

        $category->save();
        return response()->json(['name' => $data['name']]);
    }

    //////////////////////////////////////////////////////////////////////////////////////////
    //////////////////////////////////////////////////////////////////////////////////////////
    public function getSizeTable()
    {
        $sizes = Size::all();
        $data = $sizes->map(function ($sizes) {
            $btnEdit = '<button onclick="editSize(this)" class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
        <i class="fa fa-lg fa-fw fa-pen"></i>
        </button>';
            $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete" onclick="location.href = \'' . route('size.delete', ['id' => $sizes->id]) . '\'">
        <i class="fa fa-lg fa-fw fa-trash"></i>
        </button>';

            return [
                $sizes->id,
                $sizes->size,
                '<nobr>' . $btnEdit . $btnDelete . '</nobr>',
            ];
        });
        return view('layouts.admin-dashboard.size-table', ['data' => $data]);
    }

    public function saveSize(Request $request)
    {
        $size = new Size();
        $size->size = $request->add_size;
        $size->size_code = '0';
        $size->save();
        return redirect()->route('size.table');
    }

    public function editSize(Request $request)
    {
        // Get the JSON data from the request
        $data = $request->json()->all();
        $size = new Size();
        $size = Size::find($data['id']);
        $size->size = $data['size'];

        $size->save();
        return response()->json(['name' => $data['size']]);
    }

    public function sizeDeleteById($id)
    {
        Size::destroy($id);
        return redirect()->route('size.table');
    }


    // public function showUploadForm()
    // {
    //     return view('layouts.admin-dashboard.test-image-work');
    // }

    // public function upload(Request $request, $id)
    // {
    //     $product = Product::find($id);
    //     $images = $request->file('images');
    //     if ($images) {
    //         foreach ($images as $image) {
    //             // Создание экземпляра Intervention Image для каждого изображения
    //             $img = Image::make($image);
    //             $newImage = new ImageModel();
    //             $filename = $image->getClientOriginalName();
    //             $newImage->filename = $filename;
    //             $newImage->product_id = $product->id;
    //             $newImage->save();
    //             // Обработка каждого файла

    //             $img->save(public_path('multimedia/' . $filename));
    //             // Дополнительные действия, такие как сохранение информации в базу данных


    //             // Очистка экземпляра Intervention Image после обработки каждого изображения
    //         }
    //         $img->destroy();
    //         return 'Изображение успешно загружено и добавлено в базу данных.';
    //     }
    //     return 'Изображение было загружено.';
    // }
}
