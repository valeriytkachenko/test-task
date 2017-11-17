<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book`.
 */
class m171111_190144_create_book_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'author' => $this->string()->notNull(),
            'category_id' => $this->integer(),
            'description' => $this->text(),
            'pages' => $this->integer(),
            'availability' => $this->boolean(),
            'image' => $this->string(),
        ]);
        
        //creates index for column 'category_id'
        $this->createIndex(
            'idx-category_id',
            'book',
            'category_id'
        );

        //add foreign key for table 'category'
        $this->addForeignKey(
            'fk-category_id',
            'book',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('book');
    }
}
