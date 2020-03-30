<?php
namespace umbalaconmeogia\m10ldict\migrations;

/**
 * Initializes m10l dict tables.
 *
 * @author Tran Trung Thanh <umbalaconmeogia@gmail.com>
 */
class m200329_102106_m10l_dict_init extends \yii\db\Migration
{
    private $dictionaryTable = 'm10l_dict';

    private $languageTable = 'm10l_dict_language';

    private $termTable = 'm10l_dict_term';

    private $translationTable = 'm10l_dict_translation';

    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable($this->dictionaryTable, [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'created_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_at' => $this->integer(),
            'updated_by' => $this->integer(),
        ], $tableOptions);

        $this->createTable($this->languageTable, [
            'id' => $this->primaryKey(),
            'dict_id' => $this->integer(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
        ], $tableOptions);

        $this->createTable($this->termTable, [
            'id' => $this->primaryKey(),
            'dict_id' => $this->integer(),
        ], $tableOptions);

        $this->createTable($this->translationTable, [
            'id' => $this->primaryKey(),
            'term_id' => $this->integer(),
            'language_id' => $this->integer(),
            'translation' => $this->text(),
            'pronunciation' => $this->string(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $this->dropTable($this->translationTable);
        $this->dropTable($this->termTable);
        $this->dropTable($this->languageTable);
        $this->dropTable($this->dictionaryTable);
    }
}
