create table public.Cliente(
name character varying(30) not null,
cpf character(11) not null,
mail character varying(30) ,
phone_number character(11) not null,
birthday character(10) not null,
address_complement character varying(30) not null,
street character varying(30) ,
house_number integer ,
PRIMARY KEY (cpf)
);

INSERT INTO public.Cliente (name, cpf, mail, phone_number, birthday, address_complement, street, house_number)
VALUES ('Joao da silva', '12345678901', 'cliente@mail.com', '1234567890', '2000-01-01', 'Complemento do Endereço', 'Rua do Cliente', 123);

UPDATE public.Cliente
SET mail = 'novoemail@mail.com'
WHERE cpf = '12345678901';

SELECT * FROM public.Cliente;

DELETE FROM public.Cliente
WHERE cpf = '12345678901';

DROP TABLE public.Cliente;

DROP DATABASE database;




