<?php



namespace App\Admin\Controllers;



use App\Models\Profile;

use App\Models\Duo;

use Encore\Admin\Facades\Admin;



use App\Models\Location;    

use App\Models\Category;

use Encore\Admin\Controllers\AdminController;

use Encore\Admin\Form;

use Encore\Admin\Grid;

use Encore\Admin\Show;

use Illuminate\Support\Facades\Request;

 use App\Admin\Actions\Replicate;

Use Encore\Admin\Grid\Displayers\ContextMenuActions;



class ProfileController extends AdminController

{

    protected $title = 'Profiles';



    protected function grid()

    {

        $grid = new Grid(new Profile());



         



          



       // $grid->column('id', 'ID');

        $grid->column('name', 'Name');

        $grid->column('thumbnail', 'Thumbnail')->image('', 60, 60);
         
        $grid->column('order_by', 'Order By')->editable()->sortable();
        $grid->column('main_location', 'InCall Location');

        

        $grid->column('status','Available')->switch([

            'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'primary'],

            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],

        ]);

         $grid->column('desable','Publish')->switch([

            'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'primary'],

            'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],

        ]);

        



$grid->column('actions', 'Actions')->display(function () {

    $id = $this->id;



    return <<<HTML



<a href="profile/{$id}/edit" title="Edit" style="margin-right:10px;">

    <i class="fa fa-pencil"></i>

</a>

<a href="javascript:void(0);" data-_key="{$id}" class="grid-custom-delete" title="Delete">

    <i class="fa fa-trash text-danger"></i>

</a>

HTML;

});

Admin::script(<<<JS

    $(document).on('click', '.grid-custom-delete', function () {

        var id = $(this).data('_key');



        if (confirm('Are you sure you want to delete this record?')) {

            $.ajax({

                method: 'post',

                url: '/admin/profile/' + id,

                data: {

                    _method: 'delete',

                    _token: LA.token

                },

                success: function () {

                    $.pjax.reload('#pjax-container');

                },

                error: function () {

                    alert('Delete failed. Please try again.');

                }

            });

        }

    });

JS);





        $grid->disableActions();



          

        

        return $grid;

    }



    protected function detail($id)

    {

        $show = new Show(Profile::findOrFail($id));



        $show->field('name', 'Name');

        $show->field('hair', 'Hair');

        $show->field('eyes', 'Eyes');

        $show->field('nationality', 'Nationality');

        $show->field('main_location', 'Main Location');

        $show->field('bust', 'Bust');

        $show->field('dress', 'Dress');

        $show->field('orientation', 'Orientation');

        $show->field('languages', 'Languages');

        $show->field('tags', 'Tags');

        $show->field('description', 'Description');

        $show->field('whatsapp', 'Whatsapp');

        $show->field('telegram', 'Telegram');

        $show->field('starting_rate', 'Starting Rate');

        $show->field('status', 'Status');



        return $show;

    }



    protected function form()

    {

        $form = new Form(new Profile());



        $form->tab('Details', function ($form) {

            $form->image('thumbnail', 'Thumbnail')->move('uploads/profiles')->uniqueName();

           

            $form->text('name', 'Name')->required();

            $form->text('email', 'Email')->required();

            // $form->mobile('whatsapp', 'Whatsapp');

            // $form->text('telegram', 'Telegram');

             $form->text('slug', 'Slug')->rules('required|unique:profiles,slug,{{id}}');



              $form->select('status', 'Available')->options([

            '1' => 'Yes',

            '0' => 'No',

        ]);

                    $form->switch('desable', 'Publish')->states([
                'on'  => ['value' => 1, 'text' => 'Yes', 'color' => 'success'],
                'off' => ['value' => 0, 'text' => 'No', 'color' => 'danger'],
            ]);

         $form->number('order_by', 'Order By');

        });



        $form->tab('Stats', function ($form) {

            

           



             $form->select('hair', 'Hair Color')->options([

            'Black' => 'Black',

            'Brunette' => 'Brunette',

            'Brown' => 'Brown',

            'Blonde' => 'Blonde',

            'Red' => 'Red',

            'Grey' => 'Grey',

            'White' => 'White',

        ]);



        $form->select('eyes', 'Eye Color')->options([

            'Brown' => 'Brown',

            'Hazel' => 'Hazel',

            'Blue' => 'Blue',

            'Green' => 'Green',

            'Grey' => 'Grey',

            'Amber' => 'Amber',

            'Black' => 'Black',

        ]);

        $form->select('height', 'Height')->options(array_combine(
    range(140, 200),
    array_map(fn($cm) => $cm . ' cm', range(140, 200))
));

$form->select('age', 'Age')->options(array_combine(
    range(19, 58),
    array_map(fn($age) => $age . ' yrs', range(19, 58))
));



        $form->select('nationality', 'Nationality')->options([

    'American' => 'American',
    'Arab' => 'Arab',
    'Argentine' => 'Argentine',
    'Ashkenazi Jewish' => 'Ashkenazi Jewish',
    'Australian' => 'Australian',
    'Basque' => 'Basque',
    'Baloch' => 'Baloch',
    'Bengali' => 'Bengali',
    'Berber (Amazigh)' => 'Berber (Amazigh)',
    'Black African (Sub-Saharan)' => 'Black African (Sub-Saharan)',
    'Bosnian' => 'Bosnian',
    'Brazilian' => 'Brazilian',
    'British' => 'British',
    'Burmese' => 'Burmese',
    'Canadian' => 'Canadian',
    'Celtic (Irish, Scottish, Welsh, Breton)' => 'Celtic (Irish, Scottish, Welsh, Breton)',
    'Cham' => 'Cham',
    'Chinese' => 'Chinese',
    'Chinese (Han)' => 'Chinese (Han)',
    'Circassian' => 'Circassian',
    'Danish' => 'Danish',
    'Dutch' => 'Dutch',
    'Egyptian' => 'Egyptian',
    'English' => 'English',
    'Estonian' => 'Estonian',
    'Eastern European' => 'Eastern European',
    'Ethiopian' => 'Ethiopian',
    'Filipino' => 'Filipino',
    'Finnish' => 'Finnish',
    'French' => 'French',
    'Georgian' => 'Georgian',
    'German' => 'German',
    'Greek' => 'Greek',
    'Gujarati' => 'Gujarati',
    'Hazara' => 'Hazara',
    'Hmong' => 'Hmong',
    'Hungarian' => 'Hungarian',
    'Icelandic' => 'Icelandic',
    'Igbo' => 'Igbo',
    'Indian' => 'Indian',
    'Indian (various: Punjabi, Gujarati, Tamil, Bengali, etc.)' => 'Indian (various: Punjabi, Gujarati, Tamil, Bengali, etc.)',
    'Indigenous Australian (Aboriginal)' => 'Indigenous Australian (Aboriginal)',
    'Indigenous North American (Navajo, Cherokee, Sioux, Inuit, etc.)' => 'Indigenous North American (Navajo, Cherokee, Sioux, Inuit, etc.)',
    'Indonesian' => 'Indonesian',
    'Iranian (Persian, Lur, etc.)' => 'Iranian (Persian, Lur, etc.)',
    'Iraqi' => 'Iraqi',
    'Israeli' => 'Israeli',
    'Italian' => 'Italian',
    'Japanese' => 'Japanese',
    'Jewish (Ashkenazi, Sephardic, Mizrahi)' => 'Jewish (Ashkenazi, Sephardic, Mizrahi)',
    'Jordanian' => 'Jordanian',
    'Kazakh' => 'Kazakh',
    'Khmer (Cambodian)' => 'Khmer (Cambodian)',
    'Korean' => 'Korean',
    'Kurdish' => 'Kurdish',
    'Lao' => 'Lao',
    'Latvian' => 'Latvian',
    'Lebanese' => 'Lebanese',
    'Malay' => 'Malay',
    'Maori' => 'Maori',
    'Mexican' => 'Mexican',
    'Mexican (often includes Mestizo, Indigenous, etc.)' => 'Mexican (often includes Mestizo, Indigenous, etc.)',
    'Mestizo (Mixed European and Indigenous Latin American)' => 'Mestizo (Mixed European and Indigenous Latin American)',
    'Mongol' => 'Mongol',
    'Moroccan' => 'Moroccan',
    'Native Hawaiian' => 'Native Hawaiian',
    'Nepali' => 'Nepali',
    'Nigerian' => 'Nigerian',
    'Norwegian' => 'Norwegian',
    'Oromo' => 'Oromo',
    'Pashtun' => 'Pashtun',
    'Pathan' => 'Pathan',
    'Persian' => 'Persian',
    'Polish' => 'Polish',
    'Portuguese' => 'Portuguese',
    'Punjabi' => 'Punjabi',
    'Quechua' => 'Quechua',
    'Roma (Romani/Gypsy)' => 'Roma (Romani/Gypsy)',
    'Romanian' => 'Romanian',
    'Russian' => 'Russian',
    'Sami' => 'Sami',
    'Sardinian' => 'Sardinian',
    'Saudi' => 'Saudi',
    'Scottish' => 'Scottish',
    'Serbian' => 'Serbian',
    'Sindhi' => 'Sindhi',
    'Somali' => 'Somali',
    'South African' => 'South African',
    'South Sudanese' => 'South Sudanese',
    'Spanish' => 'Spanish',
    'Sudanese Arab' => 'Sudanese Arab',
    'Swedish' => 'Swedish',
    'Swiss' => 'Swiss',
    'Syrian' => 'Syrian',
    'Tamil' => 'Tamil',
    'Thai' => 'Thai',
    'Tibetan' => 'Tibetan',
    'Turkish' => 'Turkish',
    'Tutsi' => 'Tutsi',
    'Ukrainian' => 'Ukrainian',
    'Uyghur' => 'Uyghur',
    'Uzbek' => 'Uzbek',
    'Vietnamese' => 'Vietnamese',
    'Welsh' => 'Welsh',
    'White/Caucasian (varied European descent)' => 'White/Caucasian (varied European descent)',
    'Yoruba' => 'Yoruba',
    'Zulu' => 'Zulu',

]);




        $form->select('main_location', 'InCall Location')

     ->options(Location::all()->pluck('title', 'title'))

     ->required();



        $form->select('bust', 'Bust')->options([

            '28' => '28', '28A' => '28A', '28B' => '28B', '28C' => '28C', '28D' => '28D', '28DD' => '28DD',

            '30' => '30', '30A' => '30A', '30B' => '30B', '30C' => '30C', '30D' => '30D', '30DD' => '30DD',

            '32A' => '32A', '32B' => '32B', '32C' => '32C', '32D' => '32D', '32DD' => '32DD', '32E' => '32E', '32F' => '32F',

            '34A' => '34A', '34B' => '34B', '34C' => '34C', '34D' => '34D', '34DD' => '34DD', '34E' => '34E', '34F' => '34F',

            '36A' => '36A', '36B' => '36B', '36C' => '36C', '36D' => '36D', '36DD' => '36DD', '36E' => '36E', '36F' => '36F',

            '38B' => '38B', '38C' => '38C', '38D' => '38D', '38DD' => '38DD', '38E' => '38E',

            '40C' => '40C', '40D' => '40D', '40DD' => '40DD', '40E' => '40E',

            '42D' => '42D', '42DD' => '42DD',

        ]);



        $form->select('dress', 'Dress')->options([

            '6' => '6',

            '6-8' => '6-8',

            '8' => '8',

            '8-10' => '8-10',

            '10' => '10',

            '10-12' => '10-12',

            '12' => '12',

            '12-14' => '12-14',

        ]);



        $form->select('orientation', 'Orientation')->options([

            'Straight (Heterosexual)' => 'Straight (Heterosexual)',

            'Gay' => 'Gay',

            'Lesbian' => 'Lesbian',

            'Bisexual' => 'Bisexual',

            'Pansexual' => 'Pansexual',

            'Asexual' => 'Asexual',

            'Bi-curious' => 'Bi-curious',

        ]);



        $form->select('education', 'Education')->options([

    'High School' => 'High School',

    'College' => 'College',

    'Associate' => 'Associate',

    'Bachelor' => 'Bachelor',

    'University' =>'University',

    'Master' => 'Master',

]);





        $form->multipleSelect('languages', 'Languages')->options([

            'English' => 'English',

            'French' => 'French',

            'German' => 'German',

            'Spanish' => 'Spanish',

            'Italian' => 'Italian',

            'Dutch' => 'Dutch',

            'Russian' => 'Russian',

            'Portuguese' => 'Portuguese',

            'Arabic' => 'Arabic',

            'Romanian' => 'Romanian',

            'Polish' => 'Polish',

            'Czech' => 'Czech',

            'Greek' => 'Greek',

            'Hungarian' => 'Hungarian',

            'Farsi' => 'Farsi',

            'Hebrew' => 'Hebrew',

            'Swahili' => 'Swahili',

            'Turkish' => 'Turkish',

        ]);



            $form->text('tags', 'Tags');

            $form->ckeditor('description', 'Description');

            

            $form->currency('starting_rate', 'Starting Rate')->symbol('£');

        });



        $form->tab('Rates', function ($form) {

            $form->divider('Incall Rates');

            $form->text('incall_half_hour', 'Half Hour');

            $form->text('incall_1_hour', '1 Hour');

            $form->text('incall_2_hour', '2 Hours');

            $form->text('incall_3_hour', '3 Hours');

            $form->text('incall_3_hour_dinner_date', '3 Hours (Dinner Date)');

            $form->text('incall_overnight_9h', '9 Hours Overnight');

            $form->text('incall_overnight_12h', '12 Hours Overnight');

            

            $form->divider('Outcall Rates');

            $form->text('outcall_half_hour', 'Half Hour');

            $form->text('outcall_1_hour', '1 Hour');

            $form->text('outcall_2_hour', '2 Hours');

            $form->text('outcall_3_hour', '3 Hours');

            $form->text('outcall_3_hour_dinner_date', '3 Hours (Dinner Date)');

            $form->text('outcall_overnight_9h', '9 Hours Overnight');

            $form->text('outcall_overnight_12h', '12 Hours Overnight');



        });



        $form->tab('Locations & Categories', function ($form) {

            $form->multipleSelect('locations', 'Locations')->options(Location::all()->pluck('title', 'id'));

            $form->multipleSelect('categories', 'Categories')->options(Category::all()->pluck('title', 'id'));

        });
       



        $form->tab('Media', function ($form) {

           $form->multipleImage('gallery_images', 'Gallery Images')
    ->move('uploads/gallery')
    ->uniqueName()
    ->removable();


           // $form->multipleFile('gallery_videos', 'Gallery Videos')->move('uploads/videos')->uniqueName();

        });
          
        

       





       

            

    $form->tab('Duo Profiles', function ($form) {

    $segments = Request::segments();

    $currentId = isset($segments[2]) && is_numeric($segments[2]) ? (int)$segments[2] : null;



    $profiles = \App\Models\Profile::query()    

        ->when($currentId, fn ($query) => $query->where('id', '!=', $currentId))

        ->pluck('name', 'id');



    $form->multipleSelect('relatedProfiles', 'Profiles')->options($profiles);

});

$form->tab('Meta', function ($form) {

        $form->text('meta_title', 'SEO Title');
        $form->text('meta_keyword', 'SEO Keywords');
        $form->textarea('meta_discription', 'SEO Description');

    });
















        return $form;

    }



    

}

