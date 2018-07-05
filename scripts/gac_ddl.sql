USE [eworkbooks]
GO

/****** Object:  Table [dbo].[gacstp]    Script Date: 2018-07-06 9:32:57 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

SET ANSI_PADDING ON
GO

CREATE TABLE [dbo].[gacstp](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[svc_code] [varchar](8) NOT NULL,
	[svc_desc] [varchar](32) NOT NULL,
	[svc_paidyn] [varchar](1) NOT NULL,
	[extend_date_yn] [char](1) NOT NULL
) ON [PRIMARY]

GO

SET ANSI_PADDING OFF
GO

ALTER TABLE [dbo].[gacstp] ADD  CONSTRAINT [DF_gacstp_svc_paidyn]  DEFAULT ('Y') FOR [svc_paidyn]
GO

ALTER TABLE [dbo].[gacstp] ADD  DEFAULT ('Y') FOR [extend_date_yn]
GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'gacstp', @level2type=N'COLUMN',@level2name=N'extend_date_yn'
GO

