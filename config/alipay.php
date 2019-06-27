<?php
return [
    //应用ID,您的APPID。
    'app_id' => "2018090561298489",

    //商户私钥，您的原始格式RSA私钥
    'merchant_private_key' => "MIIEowIBAAKCAQEAmr6R3G3vdzYwNLK0NUjAnvS5N/SgGEclf86I9Esg1cPhQbmRSkBLzbbEvgvGDwZCJa84BRNJRtu+VhCz08j8udCMBoeLQQ2i6EGdrWgDqNAHSj//+Si4I3CFYseU7LPbsH024eJhFng0OJS9782WY5rYBwN1pCeep9/CIEaj2ZJFoFYTad80gtNlQIpDW1EuNKu7mJb+QClxq3POZdqftd6vrjJpFeAmqOws150ENu27et7qnYGH/wBWS/s5/dXSmuxKiUG55DAQsWcvEPdy6tvUWSG/we1XYz2UZbu8eJV0m1dV5O7gX3igzkgzfK9JomdvZyVFYHoQAgmZCZhhRwIDAQABAoIBAQCMxV5lu7DDrw0Nc6BSdNud/xzb1XMqgtaPPPED47B8JpStuMV+WZ1cB69U/9ruYhAcvhhlLZVUm6S8ILemq0mVNC2d5wJ8bI5NYRuy21Ow54YqOqx/GlbhDoSZRtyotDnfhRk/RjRyP2mqK03acBkmhX+OacxESDKhnwG3YOu/iVHwLrXdBJhfADlr/l5gml1gfB/G0mCKVwQVbEzEXJt3wnhLPU6s4uQUDYg//hnMrudPvIphlwBDWzSYfERQFMzVwR2+cFa+OdlVIMgbJX2gzCONwjnuK2yBMRHvzgBfkuhD6YL3mySQpWTDI4ERT2klaLLpFNxNXIRMz5drdJipAoGBAM26yMtymrXmzwwxsR/q8uUPRYOEfYfbpRMHdMC1xBMya8yw187DEdwH38l/gFWvGXdyhqL6+PkXcWfJ2R/KGgvpU8EQYqZjdyDhhLeWCyKjDJyLJTFPd+LAfol2g8QGIhGekln/H9eBCIDjf/KkmIhc27VeJei8HfOeG1/V5Ww9AoGBAMCOdIsne28LsOgHIgWl0xf7MBJJr+UChvG5HdPIBD2DGeqJDNcOV0bXkw2XkypHQzd6iunTJLZHQm5g8iyhUYgewr6FdOC6mzu1GT03UjbBkbgBNtBFenSEY9WwseeQrca5LOKB1SYCKM4Tppee+SV2eLdRammLWkvH9UyB3IfTAoGAGNPSyaKiAxPApuMUUhrDh1spc264y315VWuP7nXBHOP32HL7CEvISvp0Slflv/FqrFyY3PBWvZDTscfNOSXlsMxOvDzi+tuEE+bDYnhsDZkJu5abPXEusaGzY5l222A2GlQ9qzi7ugEraoqJ9VlhwwsZxLCA+K5DGxRYj1872a0CgYBCa2EL9ux+21uETaGQrShpZz2nsT85EWwWyTHesWm1BhnUar3BGLNGPmn9EEG1Hauz4VM1YJ2TOnVRuaMPff2vpFysd0BfnD6bk9ZG5WQ4ewCWpeSQZsbcliYRucdEBwXKPGmdIAez+p60ptaaCj4KjBkLssuv6F+XMDwOzeSR/QKBgCOQsyRNlqQ0LadLy5+2KjjefflPMLjl5VA/tswG/yAr4YfONMMYxzr0o4tvtPt16ywN+89ZPgrrS5v6OqPwgZ99CZzBGvvE9j1tCcReIJ6zVYHPPcQWy+Cjza7wVyWYD7eXKsYCPDP4P4QHr8uejADT2zwn5lkKjlfW5gMSDCRN",
    
    //异步通知地址
    'notify_url' => "https://www.whxy2018.com/alipay_notify",
    
    //同步跳转
    'return_url' => "https://www.whxy2018.com/alipay_return",

    //编码格式
    'charset' => "UTF-8",

    //签名方式
    'sign_type'=>"RSA2",

    //支付宝网关
    'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

    //支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
    'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAmr6R3G3vdzYwNLK0NUjAnvS5N/SgGEclf86I9Esg1cPhQbmRSkBLzbbEvgvGDwZCJa84BRNJRtu+VhCz08j8udCMBoeLQQ2i6EGdrWgDqNAHSj//+Si4I3CFYseU7LPbsH024eJhFng0OJS9782WY5rYBwN1pCeep9/CIEaj2ZJFoFYTad80gtNlQIpDW1EuNKu7mJb+QClxq3POZdqftd6vrjJpFeAmqOws150ENu27et7qnYGH/wBWS/s5/dXSmuxKiUG55DAQsWcvEPdy6tvUWSG/we1XYz2UZbu8eJV0m1dV5O7gX3igzkgzfK9JomdvZyVFYHoQAgmZCZhhRwIDAQAB",
];