<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("pages")->insert([
            [
                "meta_title" => "Termos de privacidade",
                "meta_description" => "Termos de privacidade",
                "slug" => "termos-de-privacidade",
                "name" => "Termos de privacidade",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mollis interdum turpis eget pellentesque.
                Nullam dapibus mauris turpis, sit amet eleifend lectus porttitor et. Phasellus egestas,
                ante sit amet maximus ullamcorper, ex purus efficitur massa, id laoreet est felis eu mi.
                In hac habitasse platea dictumst. Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas. Duis condimentum est vitae tellus cursus finibus. Nullam imperdiet sem ante. 
                Vestibulum vitae sem dui. Morbi eros nibh, dapibus id sapien vitae, viverra sagittis arcu. Suspendisse potenti. 
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;",
            ],[
                "meta_title" => "Termos e Condições do site",
                "meta_description" => "Termos e Condições do site",
                "slug" => "termos-e-condicoes-do-site",
                "name" => "Termos e Condições do site",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mollis interdum turpis eget pellentesque.
                Nullam dapibus mauris turpis, sit amet eleifend lectus porttitor et. Phasellus egestas,
                ante sit amet maximus ullamcorper, ex purus efficitur massa, id laoreet est felis eu mi.
                In hac habitasse platea dictumst. Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas. Duis condimentum est vitae tellus cursus finibus. Nullam imperdiet sem ante. 
                Vestibulum vitae sem dui. Morbi eros nibh, dapibus id sapien vitae, viverra sagittis arcu. Suspendisse potenti. 
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;",
            ],[
                "meta_title" => "Sobre a empresa",
                "meta_description" => "Sobre a empresa",
                "slug" => "sobre-empresa",
                "name" => "Termos e Condições do site",
                "content" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent mollis interdum turpis eget pellentesque.
                Nullam dapibus mauris turpis, sit amet eleifend lectus porttitor et. Phasellus egestas,
                ante sit amet maximus ullamcorper, ex purus efficitur massa, id laoreet est felis eu mi.
                In hac habitasse platea dictumst. Pellentesque habitant morbi tristique senectus et netus et malesuada fames
                ac turpis egestas. Duis condimentum est vitae tellus cursus finibus. Nullam imperdiet sem ante. 
                Vestibulum vitae sem dui. Morbi eros nibh, dapibus id sapien vitae, viverra sagittis arcu. Suspendisse potenti. 
                Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;",
            ],
        ]);
    }
}
