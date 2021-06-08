<?php
require_once "models/ObjectModel.php";

class ObjectViewModel extends ObjectModel
{
    public function __construct(array $arrayObj = null)
    {
        $this->title = "hlx";
        $this->description = 'Đọc truyện tranh các bạn có thể đọc truyện online hay mới nhất, cập nhật liên tục đọc truyện online, truyện hot nhất hiện nay tại Hentaillx.com';
        $this->keywords = "Đọc truyện, doc truyen, doc truyen tranh, truyen hay";

        if ($arrayObj != null) {
            foreach ($arrayObj as $key => $value) {
                $this->$key = $value;
            }
        }
    }
}
