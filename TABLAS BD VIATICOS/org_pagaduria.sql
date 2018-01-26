
DROP TABLE IF EXISTS org_pagaduria;
CREATE TABLE org_pagaduria (
  `id_pagaduria` int(5) UNSIGNED ZEROFILL NOT NULL,
  `pagaduria` varchar(100) DEFAULT NULL,
  `descripcion` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO org_pagaduria (id_pagaduria, pagaduria, descripcion) VALUES
(00001, 'REGIÓN CENTRAL', ''),
(00002, 'REGIÓN OCCIDENTAL', ''),
(00003, 'REGION ORIENTAL', ''),
(00004, 'REGIÓN PARACENTRAL', '');


ALTER TABLE org_pagaduria
  ADD PRIMARY KEY (`id_pagaduria`);


ALTER TABLE org_pagaduria
  MODIFY `id_pagaduria` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
