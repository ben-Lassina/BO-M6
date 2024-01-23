TYPE=VIEW
query=select `sys`.`format_path`(`performance_schema`.`file_summary_by_instance`.`FILE_NAME`) AS `file`,`performance_schema`.`file_summary_by_instance`.`COUNT_STAR` AS `total`,format_pico_time(`performance_schema`.`file_summary_by_instance`.`SUM_TIMER_WAIT`) AS `total_latency`,`performance_schema`.`file_summary_by_instance`.`COUNT_READ` AS `count_read`,format_pico_time(`performance_schema`.`file_summary_by_instance`.`SUM_TIMER_READ`) AS `read_latency`,`performance_schema`.`file_summary_by_instance`.`COUNT_WRITE` AS `count_write`,format_pico_time(`performance_schema`.`file_summary_by_instance`.`SUM_TIMER_WRITE`) AS `write_latency`,`performance_schema`.`file_summary_by_instance`.`COUNT_MISC` AS `count_misc`,format_pico_time(`performance_schema`.`file_summary_by_instance`.`SUM_TIMER_MISC`) AS `misc_latency` from `performance_schema`.`file_summary_by_instance` order by `performance_schema`.`file_summary_by_instance`.`SUM_TIMER_WAIT` desc
md5=10e6e843da56650b0f41bda3755bf3a5
updatable=1
algorithm=1
definer_user=mariadb.sys
definer_host=localhost
suid=0
with_check_option=0
timestamp=0001700839137990650
create-version=2
source=SELECT sys.format_path(file_name) AS file,\n       count_star AS total,\n       format_pico_time(sum_timer_wait) AS total_latency,\n       count_read,\n       format_pico_time(sum_timer_read) AS read_latency,\n       count_write,\n       format_pico_time(sum_timer_write) AS write_latency,\n       count_misc,\n       format_pico_time(sum_timer_misc) AS misc_latency\n  FROM performance_schema.file_summary_by_instance\n ORDER BY sum_timer_wait DESC;
client_cs_name=utf8mb3
connection_cl_name=utf8mb3_general_ci
view_body_utf8=select `sys`.`format_path`(`performance_schema`.`file_summary_by_instance`.`FILE_NAME`) AS `file`,`performance_schema`.`file_summary_by_instance`.`COUNT_STAR` AS `total`,format_pico_time(`performance_schema`.`file_summary_by_instance`.`SUM_TIMER_WAIT`) AS `total_latency`,`performance_schema`.`file_summary_by_instance`.`COUNT_READ` AS `count_read`,format_pico_time(`performance_schema`.`file_summary_by_instance`.`SUM_TIMER_READ`) AS `read_latency`,`performance_schema`.`file_summary_by_instance`.`COUNT_WRITE` AS `count_write`,format_pico_time(`performance_schema`.`file_summary_by_instance`.`SUM_TIMER_WRITE`) AS `write_latency`,`performance_schema`.`file_summary_by_instance`.`COUNT_MISC` AS `count_misc`,format_pico_time(`performance_schema`.`file_summary_by_instance`.`SUM_TIMER_MISC`) AS `misc_latency` from `performance_schema`.`file_summary_by_instance` order by `performance_schema`.`file_summary_by_instance`.`SUM_TIMER_WAIT` desc
mariadb-version=110102
