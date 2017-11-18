<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;
use app\models\SignupForm;
use app\models\ContactForm;
use app\models\Book;
use app\models\Category;
use yii\data\Pagination;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    /**
    * Display all books by pages
    */
    public function actionIndex()
    {
        $categories = Category::find()->all();
        $query = Book::find();
        $pages = new Pagination(['totalCount' => $query->count(),'pageSize' => 6]);
        $books = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->orderBy('id desc') 
        ->all();

        return $this->render('index', [
            'categories' => $categories, 
            'books' => $books,  
            'pages' => $pages,
            ]);
    }
    
    /**
    * Display all books of this category
    */
    public function actionCategory($id)
    {   
        $categories = Category::find()->all();
        $currentCategory = Category::find()->Where(['id' => $id])->one();
        $query = Book::find()->Where(['category_id' => $id]);
        $pages = new Pagination(['totalCount' => $query->count(),'pageSize' => 6]);
        $books = $query->offset($pages->offset)
        ->limit($pages->limit)
        ->orderBy('id desc') 
        ->all();
        
        return $this->render('category', [
            'categories' => $categories, 
            'books' => $books,  
            'pages' => $pages,
            'currentCategory' => $currentCategory,
            ]);
    }

    /**
    * Display one book
    */
    public function actionBook($id)
    {
        //if exists
        if($book = Book::find()->Where(['id' => $id])->one())
        {   
           return $this->render('book', [
            'book' => $book,
            ]);
        }
        else
        {
            throw new NotFoundHttpException('This entry does not exist!');
        }
        

    }
 
    /**
    * Authorization
    */
    public function actionLogin()
    {   
        //If user logged - redirect to homepage
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        //Else log in user
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
    * Registration
    */
    public function actionSignup()
    {   
        //If user logged - redirect to homepage
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        //Else sign up new user
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup())
        { 
            $identity = User::findIdentity(['username' => $model->username]);
            if (Yii::$app->user->login($identity))
            {
                return $this->goHome();
            }
        }
        
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    
    /**
    * Logout
    */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
    * Contacts page
    */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
    * About page
    */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
