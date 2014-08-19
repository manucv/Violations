CREATE TRIGGER `violations_ocupado` AFTER INSERT ON `log_parqueadero`
 FOR EACH ROW UPDATE parqueadero SET par_estado=NEW.log_par_estado WHERE par_id=NEW.par_id

CREATE TRIGGER `violations_automovil` BEFORE INSERT ON `log_parqueadero`
 FOR EACH ROW INSERT IGNORE INTO `automovil` (
    `aut_placa`
)
VALUES (
NEW.aut_placa
)

CREATE TRIGGER `violations_automovil_multa` BEFORE INSERT ON `multa_parqueadero`
 FOR EACH ROW INSERT IGNORE INTO `automovil` (
    `aut_placa`
)
VALUES (
NEW.aut_placa
)