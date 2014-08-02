CREATE TRIGGER `violations_ocupado` AFTER INSERT ON `log_parqueadero`
 FOR EACH ROW UPDATE parqueadero SET par_estado=NEW.log_par_estado WHERE par_id=NEW.par_id
