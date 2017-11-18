<?php

namespace app\models;
use yii\web\UploadedFile;
use Yii;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $name
 * @property string $author
 * @property integer $category_id
 * @property string $description
 * @property integer $pages
 * @property integer $availability
 * @property string $image
 *
 * @property Category $category
 */
class Book extends \yii\db\ActiveRecord
{
	public $picture;
	public $filename;
	public $string;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'book';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'author'], 'required'],
			[['category_id', 'pages', 'availability'], 'integer'],
			[['description'], 'string'],
			[['name', 'author'], 'string', 'max' => 255],
			[['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'name' => 'Name',
			'author' => 'Author',
			'category_id' => 'Category',
			'description' => 'Description',
			'pages' => 'Pages',
			'availability' => 'Availability',
			'image' => 'Image',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCategory()
	{
		return $this->hasOne(Category::className(), ['id' => 'category_id']);
	}
	/**
	 * Returns availability information in a readeble format
	 */
	public function getAvailabilityText()
    {
        switch ($this->availability) {
            case '1':
                return 'At home';
                break;
            case '0':
                return 'Given away';
                break;
        }
    }
	/**
	 * Uploads image to server before saving book
	 */
	public function beforeSave($insert)
	{
		//if record is new
		if ($this->isNewRecord)
		{   
			if($this->picture = UploadedFile::getInstance($this, 'image'))
			{
				//creating unique name
				$this->string = substr(uniqid('img'), 0, 12); //example: img01230120
				
				//adding file extension to name
				$this->filename = $this->string . '.' . $this->picture->extension;
				
				//saving
				$this->picture->saveAs('uploads/images/' . $this->filename);

				$this->image = $this->filename;
			}
			else
			{
				$this->image = 'default.jpg';
			}
		}
		//if updating book info
		else
		{
			//update post
			$this->picture = UploadedFile::getInstance($this, 'image');
			if($this->picture)
			{	
				//creating unique name
				$this->string = substr(uniqid('img'), 0,12);

				//adding file extension to name
				$this->filename = $this->string . '.' .$this->picture->extension;

				$this->image = $this->filename;
				$this->picture->saveAs('uploads/images/' . $this->filename);
			}
		}
		
		return parent::beforeSave($insert);
	}
}
