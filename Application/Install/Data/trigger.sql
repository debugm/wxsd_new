DROP TRIGGER IF EXISTS `moneyupdate`;
DELIMITER ;;
CREATE TRIGGER `moneyupdate` AFTER UPDATE ON `pay_apimoney`
FOR EACH ROW BEGIN
  IF NOT EXISTS (SELECT 1 FROM pay_money WHERE userid = new.userid) THEN
    INSERT INTO pay_money (userid,money,freezemoney,wallet) VALUES (new.userid,new.money,new.freezemoney,new.money);
  ELSE
    UPDATE pay_money SET money = (money + (new.money-old.money)), freezemoney = (freezemoney + (new.freezemoney-old.freezemoney)) WHERE userid = new.userid;
  END IF;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `articledel`;
DELIMITER ;;
CREATE TRIGGER `articledel` AFTER DELETE ON `pay_article` FOR EACH ROW BEGIN
    delete from pay_browserecord where article= old.id;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `bankdel`;
DELIMITER ;;
CREATE TRIGGER `bankdel` AFTER DELETE ON `pay_systembank` FOR EACH ROW BEGIN
    delete from pay_payapibank where systembankid = old.id;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `userdel`;
DELIMITER ;;
CREATE TRIGGER `userdel` AFTER DELETE ON `pay_user` FOR EACH ROW BEGIN
    delete from pay_userbasicinfo where userid = old.id;
   delete from pay_userverifyinfo where userid = old.id;
  delete from pay_userpassword where userid = old.id;
   delete from pay_money where userid = old.id;
 delete from pay_apimoney where userid = old.id;
END
;;
DELIMITER ;