<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Schema;
=======
>>>>>>> 7a30939db2bc84ce8be9732e460d94b3990ff5ef

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
<<<<<<< HEAD
        /**
         * Library Macro untuk Pencarian Dinamis Semua Field SQL
         * @param string|null $keyword Kata kunci pencarian
         */
        Builder::macro('searchAllFields', function (?string $keyword) {
            // Jika tidak ada kata kunci, langsung kembalikan query asli
            if (empty($keyword)) {
                return $this;
            }

            // Dapatkan nama tabel dari Model Eloquent yang sedang dipanggil
            $tableName = $this->getModel()->getTable();

            // Otomatis ambil semua nama kolom/field dari tabel SQL tersebut
            $columns = Schema::getColumnListing($tableName);

            // Jalankan query pencarian dinamis untuk semua kolom
            return $this->where(function (Builder $query) use ($columns, $keyword) {
                foreach ($columns as $index => $column) {
                    if ($index === 0) {
                        $query->where($column, 'LIKE', "%{$keyword}%");
                    } else {
                        $query->orWhere($column, 'LIKE', "%{$keyword}%");
                    }
                }
            });
        });
=======
        //
>>>>>>> 7a30939db2bc84ce8be9732e460d94b3990ff5ef
    }
}
