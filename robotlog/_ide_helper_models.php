<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|InvoiceLog query()
 */
	class InvoiceLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $start_date
 * @property string $end_date
 * @property string $duration
 * @property string $job_id
 * @property string $timestamp_extracted
 * @property string $dialog_title
 * @property string $error_details_log
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereDialogTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereErrorDetailsLog($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereTimestampExtracted($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobLog whereUpdatedAt($value)
 */
	class JobLog extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $robot_name
 * @property string $robot_last_activity_at
 * @property string|null $robot_diff_time_current
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotIsALive newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotIsALive newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotIsALive query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotIsALive whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotIsALive whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotIsALive whereRobotDiffTimeCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotIsALive whereRobotLastActivityAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotIsALive whereRobotName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotIsALive whereUpdatedAt($value)
 */
	class RobotIsALive extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $start_date
 * @property \Illuminate\Support\Carbon|null $end_date
 * @property string|null $duration
 * @property \Illuminate\Support\Carbon $timestamp
 * @property int $count
 * @property string $entity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RobotSysBrowser> $sysBrowsers
 * @property-read int|null $sys_browsers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount whereCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount whereEntity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotJobCount whereUpdatedAt($value)
 */
	class RobotJobCount extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int|null $index_baris
 * @property string $invoice_number
 * @property string|null $company
 * @property string|null $invoice_account
 * @property string|null $name
 * @property string|null $purchase_order
 * @property \Illuminate\Support\Carbon|null $invoice_received_date
 * @property \Illuminate\Support\Carbon|null $created_date_and_time
 * @property \Illuminate\Support\Carbon|null $c_ready_to_post_created_datetime
 * @property numeric|null $imported_invoice_amount
 * @property string|null $last_match_status
 * @property string|null $variance_approved
 * @property string|null $product_receipt
 * @property string|null $c_status
 * @property string|null $c_ca_csa_number
 * @property string|null $c_pool
 * @property string|null $c_intercompany_sales_invoice
 * @property string|null $c_tax_invoice_number
 * @property string|null $c_is_total_updated
 * @property string|null $c_is_split_invoice
 * @property string|null $c_is_split_invoice_return
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCCaCsaNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCIntercompanySalesInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCIsSplitInvoice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCIsSplitInvoiceReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCIsTotalUpdated($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCPool($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCReadyToPostCreatedDatetime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCTaxInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereCreatedDateAndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereImportedInvoiceAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereIndexBaris($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereInvoiceAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereInvoiceNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereInvoiceReceivedDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereLastMatchStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereProductReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting wherePurchaseOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotPosting whereVarianceApproved($value)
 */
	class RobotPosting extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $timestamp
 * @property int $automatic_transaction
 * @property string|null $batch_job_id
 * @property string|null $caption
 * @property string|null $invoice_no
 * @property string|null $company
 * @property string|null $server_id
 * @property string|null $status
 * @property string|null $start_date
 * @property string|null $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereAutomaticTransaction($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereBatchJobId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereCompany($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereInvoiceNo($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereServerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereTimestamp($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RobotSysBrowser whereUpdatedAt($value)
 */
	class RobotSysBrowser extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $group_user_id
 * @property string|null $avatar_url
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $teams
 * @property-read int|null $teams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User permission($permissions, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User role($roles, ?string $guard = null, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User team($teams, bool $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereAvatarUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereGroupUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutRole($roles, ?string $guard = null)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTeam($teams)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User withoutTrashed()
 */
	class User extends \Eloquent {}
}

