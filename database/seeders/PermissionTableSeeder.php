<?php
namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Permissions
        $permissions = [
            'كل الفواتير',
            'الفواتير المدفوعة',
            'الفواتير المدفوعة جزئيا',
            'الفواتير غير المدفوعة',
            'ارشيف الفواتير',

            'تقرير الفواتير',
            'تقرير العملاء',

            'قائمة المستخدمين',
            'صلاحيات المستخدمين',

            'المنتجات',
            'الاقسام',

            'اضافة فاتورة',
            'حذف الفاتورة',
            'طباعة الفاتورة',
            'ارشفة الفاتورة',
            'Excel',
            'تغيير حالة الدفع',
            'تعديل الفاتورة',

            'اضافة مرفق',
            'عرض مرفق',
            'تحميل مرفق',
            'حذف مرفق',

            'اضافة مستخدم',
            'تعديل مستخدم',
            'حذف مستخدم',

            'عرض صلاحية',
            'اضافة صلاحية',
            'تعديل صلاحية',
            'حذف صلاحية',

            'اضافة منتج',
            'تعديل منتج',
            'حذف منتج',

            'اضافة قسم',
            'تعديل قسم',
            'حذف قسم',
            'الاشعارات'

        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
