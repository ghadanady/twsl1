
    public function getIndex(Request $request)
    {
        // // if the request is ajax request
        // if ($request->ajax()) {
        //     return $this->filterProducts($request);
        // }
        //
        // $max_price = Product::max('price');
        // $min_price=  Product::min('price');
        // $products = Product::paginate(9);
        // $base_url = route('site.products.index');
        return view('site.pages.product');
    }

    public function getDetails($slug)
    {
        $id = _Product::where('slug' , $slug)->value('product_id');
        // var_dump($id);
        // exit;
        $reviews = Review::where('product_id' , $id)->get();
        $product = _Product::where('slug' , $slug)->first();
        if (!$product) {
            abort(404);
        }
        $product  = $product->master;
        return view('site.pages.products.details' , compact('product' , 'reviews'));

    }

    public function getCategory($slug , Request $request)
	{

		$category = _Category::where('slug', $slug)->first();

		if(!$category){

			abort(404);

		}

        $category = $category->master;

		if(!$category->isActive()){

			abort(404);

		}

		$products = $category->getProducts();

		if(empty($products)){

			abort(404);

		}

        // if the request is ajax request
        if ($request->ajax()) {
            return $this->filterCategoryProducts($products, $request);
        }

        $max_price = $products->max('price');
        $min_price=  $products->min('price');
        $base_url = $category->getUrl();
        $products = new LengthAwarePaginator($products, $products->count(), 9);

		return view('site.pages.products.index' , compact('products' , 'max_price' , 'min_price' , 'base_url'));
	}


    protected function filterProducts(Request $request)
    {
        $per_page = $request->per_page;
        $order = $request->order;
        $first_limit = floatval(str_replace('$', '',$request->first_limit));
        $last_limit = floatval(str_replace('$', '',$request->last_limit));
        $products = Product::whereBetween('price' ,[$first_limit , $last_limit]);

        switch ($order) {
            case 'price':
            $products->orderBy('price');
            break;
            case 'date':
            $products->orderBy('created_at');
            break;
            case 'name':
            $products = Product::join('__products', '__products.product_id', '=', 'products.id')
            ->where('__products.locale_id' ,Locale::where('name',app()->getLocale())->first()->id)
            ->whereBetween('products.price' ,[$first_limit , $last_limit])
            ->orderBy('__products.name')
            ->select('products.*') ;
            break;
        }

        $products = $products->paginate($per_page);

        return view('site.pages.products.templates.products' , compact('products'))->render();
    }

    protected function filterCategoryProducts(Collection $products, Request $request)
    {
        $per_page = $request->per_page;
        $order = $request->order;
        $first_limit = floatval(str_replace('$', '',$request->first_limit));
        $last_limit = floatval(str_replace('$', '',$request->last_limit));
        $products = $products->filter(function($product) use ($first_limit ,$last_limit){
            $price = $product->getDiscount();
            return ($price >= $first_limit && $price <= $last_limit);
        });

        switch ($order) {
            case 'price':
            $products = $products->sortBy('price');
            break;
            case 'date':
            $products = $products->sortBy('created_at');
            break;
            case 'name':
            $products = $products->sort(function($first , $last){
                return strcmp($first->translated()->name, $last->translated()->name);
            });
            break;
        }

        $products = paginate($products,$per_page);


        return view('site.pages.products.templates.products' , compact('products'))->render();
    }

      public function postReview(Request $r)
    {
        $v = validator($r->all(), [
            "review" => 'required|min:2',

        ]);
        // if the validation has been failed return the error msgs
        if ($v->fails()) {
            return ['status' => false, 'data' => implode(PHP_EOL, $v->errors()->all())];
        }

        $review = new Review();
        // save review master
        $review->member_id = Auth()->guard('members')->user()->id;
        $review->product_id = $r->product_id;
        $rate = $r->rate;
        if(is_array($rate)){
            foreach($rate as $value){
                if($value == 'rate1')
                {
                    $review->rate = '1';
                }
                elseif($value == 'rate2')
                {
                    $review->rate = '2';
                }
                elseif($value == 'rate3')
                {
                    $review->rate = '3';
                }
                elseif($value == 'rate4')
                {
                    $review->rate = '4';
                }
                elseif($value == 'rate5')
                {
                    $review->rate = '5';
                }
            }
        }

        if($review->save()){
        // save the review details
            $review->details()->create([
                'review' => $r->review,
                'locale_id'=> 1
            ]);

            return ['status' => 'success', 'msg' => 'review added successfully.'];
        }

        return ['status' => 'error', 'msg' => 'There\'re some errors, please try again later.'];
    }